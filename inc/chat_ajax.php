<?php


include('chat_config.php');

require_once("../../../../wp-load.php");
if (isset($_REQUEST['action'])) {


	switch ($_REQUEST['action']) {

		case "notification_reset":

			$data = [
				'room_id' => $_REQUEST['room_id']
			];
			$sql = "UPDATE  chat_system SET status=0 WHERE room_id=:room_id AND status=1";
			$query = $db->prepare($sql);
			$query->execute($data);

			break;

		case "notification_chat":

			$data = [
				'reciever_id' => get_current_user_id(),
			];
			$sql = "SELECT  user_id, user from chat_system where reciever_id=:reciever_id and status=1 group by user_id  order by date DESC";
			$query = $db->prepare($sql);
			$query->execute($data);
			$notification = $query->fetchAll(PDO::FETCH_ASSOC);
			$notification = json_encode($notification);
			echo $notification;
			break;

		case "SendMessage":
			
			$data = [
				'user' => $_SESSION['user'],
				'reciever' => $_REQUEST['reciever'],
				'message' =>  $_REQUEST['message'],
				'status' => 1,
				'user_id' => $_SESSION['user_id'],
				'reciever_id' => $_REQUEST['reciever_id']
			
			];
			$sql = "INSERT INTO chat_system (user, reciever, message, status, user_id, reciever_id) VALUES (:user, :reciever, :message, :status,  :user_id, :reciever_id)";
			$query = $db->prepare($sql);
			$query->execute($data);
			break;

			case "user_IP":
			
				
				$sql = "INSERT INTO users_ip_address (id, ip) VALUES (50, 60)";
				$query = $db->prepare($sql);
				$query->execute();
				break;
			
		case "SendMessageClick":
			session_start();
			$data = [
				'user' => $_SESSION['user'],
				'reciever' => $_REQUEST['reciever'],
				'message' =>  $_REQUEST['message'],
				'status' => 1,
				'user_id' => $_SESSION['user_id'],
				'reciever_id' => $_REQUEST['reciever_id'],
				'room_id' => $_REQUEST['room_id'],
				'date' => $_REQUEST['date']
			
			];
			$sql = "INSERT INTO chat_system (user, reciever, message, status, user_id, reciever_id, room_id, date) VALUES (:user, :reciever, :message, :status,  :user_id, :reciever_id, :room_id, :date)";
			$query = $db->prepare($sql);
			$query->execute($data);

			break;
		case "SendMessageFromProfile":
			$data = [
				'user' => $_SESSION['user'],
				'reciever' => $_REQUEST['reciever'],
				'message' =>  $_REQUEST['message'],
				'status' => 1,
				'user_id' => $_SESSION['user_id'],
				'reciever_id' => $_REQUEST['reciever_id'],
				'room_id' => $_REQUEST['room_id']
			
			];
			$sql = "INSERT INTO chat_system (user, reciever, message, status, user_id, reciever_id, room_id) VALUES (:user, :reciever, :message, :status,  :user_id, :reciever_id, :room_id)";
			$query = $db->prepare($sql);
			$query->execute($data);

			break;



		case "getChat":
			$state_list = array('AL'=>"Alabama",  
    'AK'=>"Alaska",  
    'AZ'=>"Arizona",  
    'AR'=>"Arkansas",  
    'CA'=>"California",  
    'CO'=>"Colorado",  
    'CT'=>"Connecticut",  
    'DE'=>"Delaware",  
    'DC'=>"District Of Columbia",  
    'FL'=>"Florida",  
    'GA'=>"Georgia",  
    'HI'=>"Hawaii",  
    'ID'=>"Idaho",  
    'IL'=>"Illinois",  
    'IN'=>"Indiana",  
    'IA'=>"Iowa",  
    'KS'=>"Kansas",  
    'KY'=>"Kentucky",  
    'LA'=>"Louisiana",  
    'ME'=>"Maine",  
    'MD'=>"Maryland",  
    'MA'=>"Massachusetts",  
    'MI'=>"Michigan",  
    'MN'=>"Minnesota",  
    'MS'=>"Mississippi",  
    'MO'=>"Missouri",  
    'MT'=>"Montana",
    'NE'=>"Nebraska",
    'NV'=>"Nevada",
    'NH'=>"New Hampshire",
    'NJ'=>"New Jersey",
    'NM'=>"New Mexico",
    'NY'=>"New York",
    'NC'=>"North Carolina",
    'ND'=>"North Dakota",
    'OH'=>"Ohio",  
    'OK'=>"Oklahoma",  
    'OR'=>"Oregon",  
    'PA'=>"Pennsylvania",  
    'RI'=>"Rhode Island",  
    'SC'=>"South Carolina",  
    'SD'=>"South Dakota",
    'TN'=>"Tennessee",  
    'TX'=>"Texas",  
    'UT'=>"Utah",  
    'VT'=>"Vermont",  
    'VA'=>"Virginia",  
    'WA'=>"Washington",  
    'WV'=>"West Virginia",  
    'WI'=>"Wisconsin",  
	'WY'=>"Wyoming");
	

			$query = $db->prepare("SELECT user_id, reciever_id, user, reciever from chat_system where user_id=:user_id or reciever_id=:reciever_id group by room_id");
			$query->execute(['reciever_id' => get_current_user_id(), 'user_id' => get_current_user_id()]);

			$results = $query->fetchAll(PDO::FETCH_ASSOC);
			$fusk = [];
			foreach($results as $klir){
				//array_push($resp, get_user_meta($klir['user_id'], 'profile_image')[0]);
				$klir_full_state = get_user_meta($klir['user_id'], 'state', true);
				$klir['user_state'] = array_search($klir_full_state, $state_list);
				$klir['user_city'] = get_user_meta($klir['user_id'], 'city', true);
				$klir['user_time_offset'] = get_user_meta($klir['user_id'], 'time_offset_registration', true);
				$klir['reciever_city'] = get_user_meta($klir['reciever_id'], 'city', true);
				$klir_reciever_full_state = get_user_meta($klir['reciever_id'], 'state', true);
				$klir['reciever_state'] = array_search($klir_reciever_full_state, $state_list);
				$klir['reciever_time_offset'] = get_user_meta($klir['reciever_id'], 'time_offset_registration', true);
				$klir['user'] = get_user_meta( $klir['user_id'], 'nickname', true);
				$klir['reciever'] = get_user_meta( $klir['reciever_id'], 'nickname', true);
				$user_name = get_user_by('id', $klir['user_id'])->data->display_name;
				$klir['user_name'] =  substr($user_name, 0, strpos($user_name, " "));
				$reciever_name = get_user_by('id', $klir['reciever_id'])->data->display_name;
				$klir['reciever_name'] = substr($reciever_name, 0, strpos($reciever_name, " "));
				
				if(get_user_meta($klir['user_id'], 'profile_image')[0] != null){
					$user_profile_image_id = get_user_meta($klir['user_id'], 'profile_image')[0];
					$profile_img_id = wp_get_attachment_id3_keys($user_profile_image_id);
					$klir['user_profile_image_thumbnail'] =  wp_get_attachment_image_src( $user_profile_image_id,  'thumbnail', true )[0];
					$klir['user_profile_image_full'] =  wp_get_attachment_image_src( $user_profile_image_id,  ',medium,', true )[0];
				}else{
					$klir['user_profile_image_thumbnail'] = get_template_directory_uri() . '/assets/images/no_person.png';
					$klir['user_profile_image_full'] = get_template_directory_uri() . '/assets/images/no_person.png';
				}
				if(get_user_meta($klir['reciever_id'], 'profile_image')[0] != null){
					$reciever_profile_image_id = get_user_meta($klir['reciever_id'], 'profile_image')[0];
					$reciever_img_id = attachment_url_to_postid($reciever_profile_image_id);
					$klir['reciever_profile_image_thumbnail'] =wp_get_attachment_image_src( $reciever_profile_image_id,  'thumbnail', true )[0];
					$klir['reciever_profile_image_full'] = wp_get_attachment_image_src( $reciever_profile_image_id, 'medium', true)[0];
				}else{
					$klir['reciever_profile_image_thumbnail'] = get_template_directory_uri() . '/assets/images/no_person.png';
					$klir['reciever_profile_image_full'] = get_template_directory_uri() . '/assets/images/no_person.png';
				}
				
				array_push($fusk, $klir);
			}
			
			$fuck = json_encode($fusk);
			echo $fuck;
			break;
			

			case "get_chat_messages":
				$data = [
					'user' => $_REQUEST['user'],
					'reciever' => $_REQUEST['reciever'],
					'to_user' => $_REQUEST['reciever'],
					'to_reciever' => $_REQUEST['user']
				];
				
				$query = $db->prepare("SELECT * from chat_system WHERE (user_id=:user AND reciever_id=:reciever) OR (user_id=:to_user AND reciever_id=:to_reciever) ORDER BY id DESC LIMIT 25");
				$query->execute($data);
	
				$results = $query->fetchAll(PDO::FETCH_ASSOC);
				$last_messages = json_encode($results);
				echo $last_messages;
			break;

			
		case "fuskara":

			session_start();
			$query = $db->prepare("SELECT * from chat_system");
			$query->execute();

			$results = $query->fetchAll(PDO::FETCH_ASSOC);
			$fusk = [];
			foreach($results as $klir){
				//array_push($resp, get_user_meta($klir['user_id'], 'profile_image')[0]);
				array_push($fusk, $klir);
				$user_state = array(
					'user_state' => get_user_meta($klir['user_id'], 'state', true)
				);
				array_push($fusk, $user_state);
			}
			
			$fuck = json_encode($fusk);
			echo $fuck;
			break;

		case 'reciever':
			session_start();
			$data = [
				'user' => $_SESSION['reciever'],

			];
			$sql = "UPDATE chat_system SET status=:status WHERE user=:user";
			$query->execute($data);
			$rr = $query->rowCount();
			echo '<div>You have ' . $rr . ' unread messages from <strong>' . $_SESSION['reciever'] . '</strong></div>';
		case 'activity':
			session_start();

			$data = [
				'now_time' => $_REQUEST['activity'],
				'user' => $_REQUEST['user']
			];

			$sql = "UPDATE chat_system SET now_time=:now_time WHERE user=:user";
			$query = $db->prepare($sql);
			$query->execute($data);
			break;
			
		case 'check_ip':

			$query = $db->prepare("SELECT * from user_road ");
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_ASSOC);

			echo json_encode($results);
			break;

		case 'insert_ip':
			$data = [
				'ip' => $_REQUEST['ip'],
				'gender' => $_REQUEST['gender'],

			];
			$sql = "INSERT INTO user_road (ip, gender) VALUES (:ip, :gender)";
			$query = $db->prepare($sql);
			$query->execute($data);
		break;

		case 'update_gender':
			$data = [
				'ip' => $_REQUEST['ip'],
				'gender' => $_REQUEST['gender']
			];

			$sql = "UPDATE user_road SET gender=:gender WHERE ip=:ip";
			$query = $db->prepare($sql);
			$query->execute($data);
			break;


		case 'send_to_room':
			$data = [
				'user' => $_REQUEST['user'],
				'reciever' => $_REQUEST['reciever'],
				'room_id' => $_REQUEST['room_id']
			];
			$sql = "INSERT INTO room (user, reciever, room_id) VALUES (:user, :reciever, :room_id)";
			$query = $db->prepare($sql);
			$query->execute($data);
			break;


		case "user_room_id":
			$data = [
				'user_id' => $_REQUEST['user_id'],
				'reciever_id' => $_REQUEST['reciever_id'],
				'to_user' =>$_REQUEST['reciever_id'],
				'to_reciever' => $_REQUEST['user_id']
			];
			$sql = "SELECT room_id from chat_system WHERE (user_id=:user_id AND reciever_id=:reciever_id) OR (user_id=:to_user AND reciever_id=:to_reciever)";
			$query = $db->prepare($sql);
			$query->execute($data);

			$result = $query->fetchAll(PDO::FETCH_ASSOC);

			echo json_encode($result);
	
			break;

		
			
	}
}
