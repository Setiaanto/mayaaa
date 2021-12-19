<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');


		if ($this->form_validation->run() == false) {
		$this->data['title'] = 'Login';
 		$this->load->view('templates/auth_header', $this->data);
 		$this->load->view('auth/login', $this->data);
 		$this->load->view('templates/auth_footer', $this->data);
			
		}else{
			$this->_login();
		}
	}
	public function google()
	{
		include_once APPPATH . "../vendor/autoload.php";
		  $google_client = new Google_Client();
		  $google_client->setClientId('572497276039-ooatvmklf7kcthhhjb8lgu71rmjhvehq.apps.googleusercontent.com'); //masukkan ClientID anda 
		  $google_client->setClientSecret('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'); //masukkan Client Secret Key anda
		  $google_client->setRedirectUri('http://localhost/mayaaa/auth/google'); //Masukkan Redirect Uri anda
		  $google_client->addScope('email');
		  $google_client->addScope('profile');

		  if(isset($_GET["code"]))
		  {
		   $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
		   if(!isset($token["error"]))
		   {
		    $google_client->setAccessToken($token['access_token']);
		    $this->session->set_userdata('access_token', $token['access_token']);
		    $google_service = new Google_Service_Oauth2($google_client);
		    $data = $google_service->userinfo->get();
		    $current_datetime = date('Y-m-d H:i:s');
		    $user_data = array(
		      'first_name' => $data['given_name'],
		      'last_name'  => $data['family_name'],
		      'email_address' => $data['email'],
		      'profile_picture'=> $data['picture'],
		      'updated_at' => $current_datetime
		     );
		    $this->session->set_userdata('user_data', $data);
		   }									
		  }
		  $login_button = '';
		  if(!$this->session->userdata('access_token'))
		  {
		  	
		   $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="https://1.bp.blogspot.com/-gvncBD5VwqU/YEnYxS5Ht7I/AAAAAAAAAXU/fsSRah1rL9s3MXM1xv8V471cVOsQRJQlQCLcBGAsYHQ/s320/google_logo.png" /></a>';
		   $data['login_button'] = $login_button;
		   $this->load->view('auth/google_login', $data);
		  }
		  else
		  {
		  	// uncomentar kode dibawah untuk melihat data session email
		  	// echo json_encode($this->session->userdata('access_token')); 
		  	// echo json_encode($this->session->userdata('user_data'));
		   redirect('content');
		  }
	}
	// public function logout()
	//  {
	//   $this->session->unset_userdata('access_token');

	//   $this->session->unset_userdata('user_data');
	//   echo "Logout berhasil";
	//  }

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			if ($user['is_active'] == 1) {
				if (password_verify($password, $user['password'])) {
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);
					redirect('content');
				}else{
					$this->session->set_flashdata('message', '<div class="alert-danger mb-2 p-2" role="alert">The password you entered is wrong!</div>');
					redirect('auth');
				}
			}else{
				$this->session->set_flashdata('message', '<div class="alert-danger mb-2 p-2" role="alert">Email has not been activated! Please do account activation.</div>');
				redirect('auth');
			}
		}else{
			$this->session->set_flashdata('message', '<div class="alert-danger mb-2 p-2" role="alert">The email you entered is not registered yet!</div>');
			redirect('auth');
		}
	}

	public function signup()
	{

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]',[
			'valid_email' => 'Please enter a valid email!',
			'is_unique' => 'The email you entered is already registered!'


		]);
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]',[
			'is_unique' => 'The username you entered is already registered!'


		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]',[
			'min_length' => 'Password minimum 8 characters!'


		]);

		if( $this->form_validation->run() == false) {
		$this->data['title'] = 'Registration';
 		$this->load->view('templates/auth_header', $this->data);
 		$this->load->view('auth/registration', $this->data);
 		$this->load->view('templates/auth_footer', $this->data);

	}else{
			$email = $this->input->post('email', true);
			$username = $this->input->post('username', true);
		$data = [
			'name' => htmlspecialchars($this->input->post('name', true)),
			'username' => htmlspecialchars($username),
			'email' => htmlspecialchars($email),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'role_id' => 2,
			'is_active' => 0,
			'date_created' => time()
		];

		$token = base64_encode(random_bytes(32));
		$user_token = [
			'email' => $email,
			'token' => $token,
			'date_created' => time()
		];

		$this->db->insert('user', $data);
		$this->db->insert('user_token', $user_token);

		$this->_sendEmail($token, 'verify');


		$this->session->set_flashdata('message', '<div class="alert-success mb-2 p-2" role="alert">Account created successfully. Activate the account first before logging in.</div>');
		redirect('auth');


		}

	}

	private function _sendEmail($token, $type)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_user' => 'khusustugas098@gmail.com',
			'smtp_pass' => 'popololo098',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"

		];

		$this->load->library('email', $config);

		$this->email->from('khusustugas098@gmail.com', 'Achmad Gigih Setianto');
		$this->email->to($this->input->post('email'));

		if ($type == 'verify') {
		$this->email->subject('Account verification');
		$this->email->message('To verify the account, please click the following link : '.base_url().'auth/verify?email='. $this->input->post('email'). '&token='. urlencode($token));
			
		} else if($type == 'forgot'){
			$this->email->subject('Reset Password');
			$this->email->message('To reset password please click the following link : '.base_url().'auth/resetpassword?email='. $this->input->post('email'). '&token='. urlencode($token));
		}


		if ($this->email->send()) {
			return true;
		}else{
			echo $this->email->print_debugger();
			die;
		}
	}

	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])-> row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
			if ($user_token) {
				if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('user');

					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('message', '<div class="alert-success mb-2 p-2" role="alert">'. $email .' has been activated! Please login.</div>');
					redirect('auth');

				} else {
					$this->db->delete('user', ['email' => $email]);
					$this->db->delete('user_token', ['email' => $email]);
					$this->session->set_flashdata('message', '<div class="alert-danger mb-2 p-2" role="alert">Activation failed! Expired token</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert-danger mb-2 p-2" role="alert">Activation failed! Invalid token</div>');
				redirect('auth');
			}
		}else {
			$this->session->set_flashdata('message', '<div class="alert-danger mb-2 p-2" role="alert">Activation failed! Invalid email</div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('access_token');

	  	$this->session->unset_userdata('user_data');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', '<div class="alert-success mb-2 p-2" role="alert">You have logged out</div>');
		redirect('auth');
	}

	public function forgotpassword()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if ($this->form_validation->run() == false) {
		$this->data['title'] = 'Forgot Password';
 		$this->load->view('templates/auth_header', $this->data);
 		$this->load->view('auth/forgot', $this->data);
 		$this->load->view('templates/auth_footer', $this->data);
			
		} else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('user', ['email' => $email, 'is_active' == 1])->row_array();

			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];

				$this->db->insert('user_token', $user_token);
				$this->_sendEmail($token, 'forgot');

				$this->session->set_flashdata('message', '<div class="alert-success mb-2 p-2" role="alert">Check your email to change password</div>');
				redirect('auth/forgotpassword');
			} else {
				$this->session->set_flashdata('message', '<div class="alert-danger mb-2 p-2" role="alert">Email has not been registered or has not been activated</div>');
				redirect('auth/forgotpassword');
			}
		}
	}

	public function resetPassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if ($user_token) {
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();
			} else {
				$this->session->set_flashdata('message', '<div class="alert-danger mb-2 p-2" role="alert">Failed to reset password!</div>');
			redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert-danger mb-2 p-2" role="alert">Failed to reset password! Email not found.</div>');
			redirect('auth');
		}
	}
	public function changepassword()
	{


		if (!$this->session->userdata('reset_email')) {
			redirect('auth');
		}

		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|matches[passwordrepeat]');
		$this->form_validation->set_rules('passwordrepeat', 'Passwordrepeat', 'trim|required|min_length[8]|matches[password]');
		if ($this->form_validation->run() == false) {
		$this->data['title'] = 'Create new password';
 		$this->load->view('templates/auth_header', $this->data);
 		$this->load->view('auth/password_reset', $this->data);
 		$this->load->view('templates/auth_footer', $this->data);
			
		} else {
			$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('user');

			$this->session->unset_userdata('reset_email');

			$this->session->set_flashdata('message', '<div class="alert-success mb-2 p-2" role="alert">Password successfully changed! Please login.</div>');
			redirect('auth');
		}
	}
}