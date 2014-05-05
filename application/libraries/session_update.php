<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require_once BASEPATH . '/libraries/Session.php';

	class Session_Update extends CI_Session{

		function session_add()
		{
			$session_id=$this->userdata['session_id'];
			$table_name=$this->sess_table_name;
			$query="SELECT session_id FROM ".$table_name." WHERE session_id = ? LIMIT 1";
			$result=$this->db->query($query,array($session_id));
			if ($result->num_rows() > 0) {
				$this->sess_update();
			}
			else{
				$last_activity=$this->userdata['last_activity'];
				$ip_address=$this->userdata['ip_address'];
				$user_agent=$this->userdata['user_agent'];
				$data=array(
					'id'=> $this->userdata['id'],
					'is_logged_in'=> $this->userdata['is_logged_in']
				);
				$userdata=serialize($data);
				$query="INSERT INTO ".$table_name." (session_id,ip_address,user_agent,last_activity,user_data) VALUES(?,?,?,?,?)";
				$result=$this->db->query($query,array($session_id));
				if ($result) {
		 			return true;
		 		}
		 		else{
		 			return false;
		 		}
			}
		}


		/**
		 * Update an existing session
		 *
		 * @access  public
		 * @return  void
		 */
		function sess_update()
		{
		    // We only update the session every five minutes by default
		    if (($this->userdata['last_activity'] + $this->sess_time_to_update) >= $this->now)
		    {
		        return;
		    }
		 
		    // Save the old session id so we know which record to
		    // update in the database if we need it
		    $old_sessid = $this->userdata['session_id'];
		    $new_sessid = '';
		    while (strlen($new_sessid) < 32)
		    {
		        $new_sessid .= mt_rand(0, mt_getrandmax());
		    }
		 
		    // To make the session ID even more secure we'll combine it with the user's IP
		    $new_sessid .= $this->CI->input->ip_address();
		 
		    // Turn it into a hash
		    $new_sessid = md5(uniqid($new_sessid, TRUE));
		 
		    // Update the session data in the session data array
		    $this->userdata['session_id'] = $new_sessid;
		    $this->userdata['last_activity'] = $this->now;
		 
		    // _set_cookie() will handle this for us if we aren't using database sessions
		    // by pushing all userdata to the cookie.
		    $cookie_data = NULL;
		 
		    // Update the session ID and last_activity field in the DB if needed
		    if ($this->sess_use_database === TRUE)
		    {
		        // set cookie explicitly to only have our session data
		        $cookie_data = array();
		        foreach (array('session_id','ip_address','user_agent','last_activity') as $val)
		        {
		            $cookie_data[$val] = $this->userdata[$val];
		        }
		 
		        $this->CI->db->query($this->CI->db->update_string($this->sess_table_name, array('last_activity' => $this->now, 'session_id' => $new_sessid), array('session_id' => $old_sessid)));
		    }
		 
		    // Write the cookie
		    $this->_set_cookie($cookie_data);
		}
	}