<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Lang - English
*
* Author: Ben Edmunds
*         ben.edmunds@gmail.com
*         @benedmunds
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.14.2010
*
* Description:  English language file for Ion Auth messages and errors
*
*/

// Account Creation
// $lang['account_creation_successful']            = 'Account Successfully Created';
// $lang['account_creation_unsuccessful']          = 'Unable to Create Account';
// $lang['account_creation_duplicate_email']       = 'Email Already Used or Invalid';
// $lang['account_creation_duplicate_identity']    = 'Identity Already Used or Invalid';
// $lang['account_creation_missing_default_group'] = 'Default group is not set';
// $lang['account_creation_invalid_default_group'] = 'Invalid default group name set';


// // Password
// $lang['password_change_successful']          = 'Password Successfully Changed';
// $lang['password_change_unsuccessful']        = 'Unable to Change Password';
// $lang['forgot_password_successful']          = 'Password Reset Email Sent';
// $lang['forgot_password_unsuccessful']        = 'Unable to Reset Password';

// // Activation
// $lang['activate_successful']                 = 'Account Activated';
// $lang['activate_unsuccessful']               = 'Unable to Activate Account';
// $lang['deactivate_successful']               = 'Account De-Activated';
// $lang['deactivate_unsuccessful']             = 'Unable to De-Activate Account';
// $lang['activation_email_successful']         = 'Activation Email Sent. Please check your inbox or spam';
// $lang['activation_email_unsuccessful']       = 'Unable to Send Activation Email';

// // Login / Logout
// $lang['login_successful']                    = 'Logged In Successfully';
// $lang['login_unsuccessful']                  = 'Incorrect Login';
// $lang['login_unsuccessful_not_active']       = 'Account is inactive';
// $lang['login_timeout']                       = 'Temporarily Locked Out.  Try again later.';
// $lang['logout_successful']                   = 'Logged Out Successfully';

// // Account Changes
// $lang['update_successful']                   = 'Account Information Successfully Updated';
// $lang['update_unsuccessful']                 = 'Unable to Update Account Information';
// $lang['delete_successful']                   = 'User Deleted';
// $lang['delete_unsuccessful']                 = 'Unable to Delete User';

// // Groups
// $lang['group_creation_successful']           = 'Group created Successfully';
// $lang['group_already_exists']                = 'Group name already taken';
// $lang['group_update_successful']             = 'Group details updated';
// $lang['group_delete_successful']             = 'Group deleted';
// $lang['group_delete_unsuccessful']           = 'Unable to delete group';
// $lang['group_delete_notallowed']             = 'Can\'t delete the administrators\' group';
// $lang['group_name_required']                 = 'Group name is a required field';
// $lang['group_name_admin_not_alter']          = 'Admin group name can not be changed';

// // Activation Email
// $lang['email_activation_subject']            = 'Account Activation';
// $lang['email_activate_heading']              = 'Activate account for %s';
// $lang['email_activate_subheading']           = 'Please click this link to %s.';
// $lang['email_activate_link']                 = 'Activate Your Account';

// // Forgot Password Email
// $lang['email_forgotten_password_subject']    = 'Forgotten Password Verification';
// $lang['email_forgot_password_heading']       = 'Reset Password for %s';
// $lang['email_forgot_password_subheading']    = 'Please click this link to %s.';
// $lang['email_forgot_password_link']          = 'Reset Your Password';

// // New Password Email
// $lang['email_new_password_subject']          = 'New Password';
// $lang['email_new_password_heading']          = 'New Password for %s';
// $lang['email_new_password_subheading']       = 'Your password has been reset to: %s';


$lang['account_creation_successful'] 	  	 = 'สร้างบัญชีสำเร็จ';
$lang['account_creation_unsuccessful'] 	 	 = 'ไม่สามารถสร้างบัญชีได้';
$lang['account_creation_duplicate_email'] 	 = 'อีเมล์นี้ถูกใช้ไปแล้วหรือรูปแบบไม่ถูกต้อง';
$lang['account_creation_duplicate_identity'] = 'ชื่อผู้ใช้นี้ถูกใช้ไปแล้วหรือรูปแบบไม่ถูกต้อง';
$lang['account_creation_missing_default_group'] = 'กลุ่มปริยายยังไม่ถูกตั้ง';
$lang['account_creation_invalid_default_group'] = 'ชื่อกลุ่มปริยายตั้งไม่ถูกต้อง';


// Password
$lang['password_change_successful'] 	 	 = 'เปลี่ยนรหัสผ่านสำเร็จ';
$lang['password_change_unsuccessful'] 	  	 = 'ไม่สามารถเปลี่ยนรหัสผ่านได้';
$lang['forgot_password_successful'] 	 	 = 'อีเมล์ล้างรหัสผ่านถูกส่งไปแล้ว';
$lang['forgot_password_unsuccessful'] 	 	 = 'ไม่สามารถล้างรหัสผ่านได้';

// Activation
$lang['activate_successful'] 		  	     = 'บัญชีเปิดใช้แล้ว';
$lang['activate_unsuccessful'] 		 	     = 'ไม่สามารถเปิดใช้บัญชีได้';
$lang['deactivate_successful'] 		  	     = 'บัญชีถูกปิดการใช้งานแล้ว';
$lang['deactivate_unsuccessful'] 	  	     = 'ไม่สามารถปิดการใช้งานบัญชี';
$lang['activation_email_successful'] 	  	 = 'ส่งอีเมล์เปิดใช้งานแล้ว';
$lang['activation_email_unsuccessful']   	 = 'ไม่สามารถส่งอีเมล์เปิดใช้งานรหัสผ่านได้';

// Login / Logout
$lang['login_successful'] 		  	         = 'เข้าสู่ระบบสำเร็จ';
$lang['login_unsuccessful'] 		  	     = 'เข้าสู่ระบบไม่ถูกต้อง';
$lang['login_unsuccessful_not_active'] 		 = 'บัญชีนี้ยังไม่เปิดใช้งาน';
$lang['login_timeout']                       = 'การเข้าสู่ระบบถูกระงับชั่วคราว กรุณาลองใหม่ในภายหลัง.';
$lang['logout_successful'] 		 	         = 'ออกจากระบบสำเร็จ';

// Accounts Changes
$lang['update_successful'] 		 	         = 'แก้ไขข้อมูลบัญชีสำเร็จ';
$lang['update_unsuccessful'] 		 	     = 'ไม่สามารถแก้ไขข้อมูลบัญชี';
$lang['delete_successful']               = 'ผู้ใช้ถูกลบแล้ว';
$lang['delete_unsuccessful']           = 'ไม่สามารถลบผู้ใช้ได้';

// Groups
$lang['group_creation_successful']  = 'สร้างกลุ่มสำเร็จ';
$lang['group_already_exists']       = 'ชื่อกลุ่มถูกใช้ไปแล้ว';
$lang['group_update_successful']    = 'แก้ไขรายละเอียดกลุ่มแล้ว';
$lang['group_delete_successful']    = 'กลุ่มถูกลบแล้ว';
$lang['group_delete_unsuccessful'] 	= 'ไม่สามารถลบกลุ่มได้';
$lang['group_delete_notallowed']    = 'Can\'t delete the administrators\' group';
$lang['group_name_required'] 		= 'ต้องใส่ชื่อกลุ่ม';
$lang['group_name_admin_not_alter'] = 'Admin group name can not be changed';

// Activation Email
$lang['email_activation_subject']            = 'การเปิดใช้บัญชี';
$lang['email_activate_heading']    = 'เปิดใช้บัญชี %s';
$lang['email_activate_subheading'] = 'กรุณาคลิกลิงค์นี้เพื่อ%s';
$lang['email_activate_link']       = 'เปิดใช้Your บัญชี';

// Forgot Password Email
$lang['email_forgotten_password_subject']    = 'การยืนยันลืมรหัสผ่าน';
$lang['email_forgot_password_heading']    = 'ล้างรหัสผ่านสำหรับ%s';
$lang['email_forgot_password_subheading'] = 'กรุณาคลิกลิงค์นี้เพื่อ%s';
$lang['email_forgot_password_link']       = 'ล้างรหัสผ่าน';

// New Password Email
$lang['email_new_password_subject']          = 'รหัสผ่านใหม่';
$lang['email_new_password_heading']    = 'รหัสผ่านใหม่สำหรับ%s';
$lang['email_new_password_subheading'] = 'รหัสผ่านใหม่ถูกตั้งใหม่เป็น: %s';
