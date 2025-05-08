<?php

use App\Models\EmailTemplate;
use App\Models\Extension;
use App\Models\Frontend;
use App\Models\GeneralSetting;
use App\Models\Plan;
use App\Models\Menu;
use App\Models\SmsTemplate;
use App\Models\User;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Carbon\Carbon;


function sidebarVariation(){

    /// for sidebar
    $variation['sidebar'] = 'bg_img';

    //for selector
    $variation['selector'] = 'capsule--rounded';
    //for overlay

    $variation['overlay'] = 'overlay--dark';
    //Opacity
    $variation['opacity'] = 'overlay--opacity-8'; // 1-10

    return $variation;

}
function slug($string)
{
    return Illuminate\Support\Str::slug($string);
}


function shortDescription($string, $length = 120)
{
    return Illuminate\Support\Str::limit($string, $length);
}


function shortCodeReplacer($shortCode, $replace_with, $template_string)
{
    return str_replace($shortCode, $replace_with, $template_string);
}


function verificationCode($length)
{
    if ($length == 0) return 0;
    $min = pow(10, $length - 1);
    $max = 0;
    while ($length > 0 && $length--) {
        $max = ($max * 10) + 9;
    }
    return random_int($min, $max);
}

function getNumber($length = 8)
{
    $characters = '1234567890';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function uploadImage($file, $location, $size = null, $old = null, $thumb = null)
{
    $path = makeDirectory($location);
    if (!$path) throw new Exception('File could not been created.');

    if (!empty($old)) {
        removeFile($location . '/' . $old);
        removeFile($location . '/thumb_' . $old);
    }
    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();
    $image = Image::make($file);
    if (!empty($size)) {
        $size = explode('x', strtolower($size));
        $image->resize($size[0], $size[1],function($constraint){
            $constraint->upsize();
        });
    }
    $image->save($location . '/' . $filename);

    if (!empty($thumb)) {

        $thumb = explode('x', $thumb);
        Image::make($file)->resize($thumb[0], $thumb[1],function($constraint){
            $constraint->upsize();
        })->save($location . '/thumb_' . $filename);
    }

    return $filename;
}

function uploadFile($file, $location, $size = null, $old = null){
    $path = makeDirectory($location);
    if (!$path) throw new Exception('File could not been created.');

    if (!empty($old)) {
        removeFile($location . '/' . $old);
    }

    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();
    $file->move($location,$filename);
    return $filename;
}

function makeDirectory($path)
{
    if (file_exists($path)) return true;
    return mkdir($path, 0755, true);
}


function removeFile($path)
{
    return file_exists($path) && is_file($path) ? @unlink($path) : false;
}


function activeTemplate($asset = false)
{
    $gs = GeneralSetting::first(['active_template']);
    $template = 'basic';//$gs->active_template;
    $sess = session()->get('template');
    if (trim($sess) != null) {
        $template = $sess;
    }
    if ($asset) return 'assets/templates/' . $template . '/';
    return 'templates.' . $template . '.';
}

function activeTemplateName()
{
    $gs = GeneralSetting::first(['active_template']);
    $template = $gs->active_template;
    $sess = session()->get('template');
    if (trim($sess) != null) {
        $template = $sess;
    }
    return $template;
}

function reCaptcha()
{
    $reCaptcha = Extension::where('act', 'google-recaptcha2')->where('status', 1)->first();
    return $reCaptcha ? $reCaptcha->generateScript() : '';
}

function analytics()
{
    $analytics = Extension::where('act', 'google-analytics')->where('status', 1)->first();
    return $analytics ? $analytics->generateScript() : '';
}

function tawkto()
{
    $tawkto = Extension::where('act', 'tawk-chat')->where('status', 1)->first();
    return $tawkto ? $tawkto->generateScript() : '';
}

function fbcomment()
{
    $comment = Extension::where('act', 'fb-comment')->where('status',1)->first();
    return  $comment ? $comment->generateScript() : '';
}

function getCustomCaptcha($height = 46, $width = '300px', $bgcolor = '#003', $textcolor = '#abc')
{
    $textcolor = '#'.GeneralSetting::first()->base_color;
    $captcha = Extension::where('act', 'custom-captcha')->where('status', 1)->first();
    if($captcha){
        $code = rand(100000, 999999);
        $char = str_split($code);
        $ret = '<link href="https://fonts.googleapis.com/css?family=Henny+Penny&display=swap" rel="stylesheet">';
        $ret .= '<div style="height: ' . $height . 'px; line-height: ' . $height . 'px; width:' . $width . '; text-align: center; background-color: ' . $bgcolor . '; color: ' . $textcolor . '; font-size: ' . ($height - 20) . 'px; font-weight: bold; letter-spacing: 20px; font-family: \'Henny Penny\', cursive;  -webkit-user-select: none; -moz-user-select: none;-ms-user-select: none;user-select: none;  display: flex; justify-content: center;">';
        foreach ($char as $value) {
            $ret .= '<span style="    float:left;     -webkit-transform: rotate(' . rand(-60, 60) . 'deg);">' . $value . '</span>';
        }
        $ret .= '</div>';
        $captchaSecret = hash_hmac('sha256', $code, $captcha->shortcode->random_key->value);
        $ret .= '<input type="hidden" name="captcha_secret" value="' . $captchaSecret . '">';
        return $ret;
    }else{
        return false;
    }
}


function captchaVerify($code, $secret)
{
    $captcha = Extension::where('act', 'custom-captcha')->where('status', 1)->first();
    $captchaSecret = hash_hmac('sha256', $code, $captcha->shortcode->random_key->value);
    if ($captchaSecret == $secret) {
        return true;
    }
    return false;
}

function getTrx($length = 12)
{
    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function getAmount($amount, $length = 0)
{
    if(0 < $length){
        return round($amount + 0, $length);
    }
    return $amount + 0;
}

function removeElement($array, $value)
{
    return array_diff($array, (is_array($value) ? $value : array($value)));
}

function cryptoQR($wallet, $amount, $crypto = null)
{

    $varb = $wallet . "?amount=" . $amount;
    return "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$varb&choe=UTF-8";
}

//moveable
function curlContent($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

//moveable
function curlPostContent($url, $arr = null)
{
    if ($arr) {
        $params = http_build_query($arr);
    } else {
        $params = '';
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}


function inputTitle($text)
{
    return ucfirst(preg_replace("/[^A-Za-z0-9 ]/", ' ', $text));
}


function titleToKey($text)
{
    return strtolower(str_replace(' ', '_', $text));
}


function str_slug($title = null)
{
    return \Illuminate\Support\Str::slug($title);
}

function str_limit($title = null, $length = 10)
{
    return \Illuminate\Support\Str::limit($title, $length);
}

//moveable
function getIpInfo()
{
    $ip = null;
    $deep_detect = TRUE;

    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    //$ip  = '119.160.68.12';
    $xml = @simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=" . $ip);
    $country = @$xml->geoplugin_countryName;
    $city = @$xml->geoplugin_city;
    $area = @$xml->geoplugin_areaCode;
    $code = @$xml->geoplugin_countryCode;
    $long = @$xml->geoplugin_longitude;
    $lat = @$xml->geoplugin_latitude;

    $data['country'] = $country;
    $data['city'] = $city;
    $data['area'] = $area;
    $data['code'] = $code;
    $data['long'] = $long;
    $data['lat'] = $lat;
    $data['ip'] = request()->ip();
    $data['time'] = date('d-m-Y h:i:s A');


    return $data;
}

//moveable
function osBrowser(){
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $os_platform = "Unknown OS Platform";
    $os_array = array(
        '/windows nt 10/i' => 'Windows 10',
        '/windows nt 6.3/i' => 'Windows 8.1',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows 7',
        '/windows nt 6.0/i' => 'Windows Vista',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/linux/i' => 'Linux',
        '/ubuntu/i' => 'Ubuntu',
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    );
    foreach ($os_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $os_platform = $value;
        }
    }
    $browser = "Unknown Browser";
    $browser_array = array(
        '/msie/i' => 'Internet Explorer',
        '/firefox/i' => 'Firefox',
        '/safari/i' => 'Safari',
        '/chrome/i' => 'Chrome',
        '/edge/i' => 'Edge',
        '/opera/i' => 'Opera',
        '/netscape/i' => 'Netscape',
        '/maxthon/i' => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i' => 'Handheld Browser'
    );
    foreach ($browser_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $browser = $value;
        }
    }

    $data['os_platform'] = $os_platform;
    $data['browser'] = $browser;

    return $data;
}

function siteName()
{
    $general = GeneralSetting::first();
    $sitname = str_word_count($general->sitename);
    $sitnameArr = explode(' ', $general->sitename);
    if ($sitname > 1) {
        $title = "<span>$sitnameArr[0] </span> " . str_replace($sitnameArr[0], '', $general->sitename);
    } else {
        $title = "<span>$general->sitename</span>";
    }

    return $title;
}


//moveable
function getPageSections($arr = false)
{

    $jsonUrl = resource_path('views/') . str_replace('.', '/', activeTemplate()) . 'sections.json';
    $sections = json_decode(file_get_contents($jsonUrl));
    if ($arr) {
        $sections = json_decode(file_get_contents($jsonUrl), true);
        ksort($sections);
    }
    return $sections;
}


function getImage($image,$size = null, $isAvatar=false)
{
    $clean = '';
    $size = $size ? $size : 'undefined';
    if (file_exists($image) && is_file($image)) {
        return asset($image) . $clean;
    }elseif($isAvatar){
        return asset('assets/images/avatar.png');
    }else{
        return route('placeholderImage',$size);
    }
}

function notify($user, $type, $shortCodes = null)
{
    sendEmail($user, $type, $shortCodes);
    sendSms($user, $type, $shortCodes);
}


/*SMS EMIL moveable*/

function sendSms($user, $type, $shortCodes = [])
{
    $general = GeneralSetting::first(['sn', 'sms_api']);
    $sms_template = SmsTemplate::where('act', $type)->where('sms_status', 1)->first();
    if ($general->sn == 1 && $sms_template) {

        $template = $sms_template->sms_body;

        foreach ($shortCodes as $code => $value) {
            $template = shortCodeReplacer('{{ ' . $code . ' }}', $value, $template);
        }
        $template = urlencode($template);

        $message = shortCodeReplacer("{{ number }}", $user->mobile, $general->sms_api);
        $message = shortCodeReplacer("{{ message }}", $template, $message);
        $result = @curlContent($message);
    }
}

function sendEmail($user, $type = null, $shortCodes = [])
{
    $general = GeneralSetting::first();

    $email_template = EmailTemplate::where('act', $type)->where('email_status', 1)->first();
    if ($general->en != 1 || !$email_template) {
        return;
    }

    $message = shortCodeReplacer("{{ name }}", $user->username, $general->email_template);
    $message = shortCodeReplacer("{{ message }}", $email_template->email_body, $message);

    if (empty($message)) {
        $message = $email_template->email_body;
    }

    foreach ($shortCodes as $code => $value) {
        $message = shortCodeReplacer('{{ ' . $code . ' }}', $value, $message);
    }
    $config = $general->mail_config;

    if ($config->name == 'php') {
        sendPhpMail($user->email, $user->username,$email_template->subj, $message);
    } else if ($config->name == 'smtp') {
        sendSmtpMail($config, $user->email, $user->username, $email_template->subj, $message,$general);
    } else if ($config->name == 'sendgrid') {
        sendSendGridMail($config, $user->email, $user->username, $email_template->subj, $message,$general);
    } else if ($config->name == 'mailjet') {
        sendMailjetMail($config, $user->email, $user->username, $email_template->subj, $message,$general);
    }
}


function sendPhpMail($receiver_email, $receiver_name, $subject, $message)
{
    $gnl = GeneralSetting::first();
    $headers = "From: $gnl->sitename <$gnl->email_from> \r\n";
    $headers .= "Reply-To: $gnl->sitename <$gnl->email_from> \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";
@mail($receiver_email, $subject, $message, $headers);
}


function sendSmtpMail($config, $receiver_email, $receiver_name, $subject, $message,$gnl)
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = $config->host;
        $mail->SMTPAuth   = true;
        $mail->Username   = $config->username;
        $mail->Password   = $config->password;
        if ($config->enc == 'ssl') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        }else{
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        }
        $mail->Port       = $config->port;
        $mail->CharSet = 'UTF-8';
        //Recipients
        $mail->setFrom($gnl->email_from, $gnl->sitetitle);
        $mail->addAddress($receiver_email, $receiver_name);
        $mail->addReplyTo($gnl->email_from, $gnl->sitename);
        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->send();
    } catch (Exception $e) {
        throw new Exception($e);
    }
}


function sendSendGridMail($config, $receiver_email, $receiver_name, $subject, $message,$gnl)
{
    $sendgridMail = new \SendGrid\Mail\Mail();
    $sendgridMail->setFrom($gnl->email_from, $gnl->sitetitle);
    $sendgridMail->setSubject($subject);
    $sendgridMail->addTo($receiver_email, $receiver_name);
    $sendgridMail->addContent("text/html", $message);
    $sendgrid = new \SendGrid($config->appkey);
    try {
        $response = $sendgrid->send($sendgridMail);
    } catch (Exception $e) {
        // echo 'Caught exception: '. $e->getMessage() ."\n";
    }
}


function sendMailjetMail($config, $receiver_email, $receiver_name, $subject, $message,$gnl)
{
    $mj = new \Mailjet\Client($config->public_key, $config->secret_key, true, ['version' => 'v3.1']);
    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => $gnl->email_from,
                    'Name' => $gnl->sitetitle,
                ],
                'To' => [
                    [
                        'Email' => $receiver_email,
                        'Name' => $receiver_name,
                    ]
                ],
                'Subject' => $subject,
                'TextPart' => "",
                'HTMLPart' => $message,
            ]
        ]
    ];
    $response = $mj->post(\Mailjet\Resources::$Email, ['body' => $body]);
}


function getPaginate($paginate = 20)
{
    return $paginate;
}


function menuActive($routeName, $type = null)
{
    if ($type == 3) {
        $class = 'side-menu--open';
    } elseif ($type == 2) {
        $class = 'sidebar-submenu__open';
    } else {
        $class = 'active';
    }
    if (is_array($routeName)) {
        foreach ($routeName as $key => $value) {
            if (request()->routeIs($value)) {
                return $class;
            }
        }
    } elseif (request()->routeIs($routeName)) {
        return $class;
    }
}


function imagePath()
{
    $data['gateway'] = [
        'path' => 'assets/images/gateway',
        'size' => '800x800',
    ];
    $data['verify'] = [
        'withdraw'=>[
            'path'=>'assets/images/verify/withdraw'
        ],
        'deposit'=>[
            'path'=>'assets/images/verify/deposit'
        ]
    ];
    $data['image'] = [
        'default' => 'assets/images/default.png',
    ];
    $data['withdraw'] = [
        'method' => [
            'path' => 'assets/images/withdraw/method',
            'size' => '800x800',
        ]
    ];
    $data['ticket'] = [
        'path' => 'assets/images/support',
    ];
    $data['language'] = [
        'path' => 'assets/images/lang',
        'size' => '64x64'
    ];
    $data['logoIcon'] = [
        'path' => 'assets/images/logoIcon',
    ];
    $data['favicon'] = [
        'size' => '128x128',
    ];
    $data['extensions'] = [
        'path' => 'assets/images/extensions',
    ];
    $data['seo'] = [
        'path' => 'assets/images/seo',
        'size' => '600x315'
    ];
    $data['profile'] = [
        'user'=> [
            'path'=>'assets/images/user/profile',
            'size'=>'350x300'
        ],
        'admin'=> [
            'path'=>'assets/admin/images/profile',
            'size'=>'400x400'
        ]
    ];
    return $data;
}

function diffForHumans($date)
{
    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->diffForHumans();
}

function showDateTime($date, $format = 'd M, Y h:i A')
{
    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->translatedFormat($format);
}

//moveable
function sendGeneralEmail($email, $subject, $message, $receiver_name = '')
{

    $general = GeneralSetting::first();

    if ($general->en != 1 || !$general->email_from) {
        return;
    }
    $message = shortCodeReplacer("{{ message }}", $message, $general->email_template);
    $message = shortCodeReplacer("{{ name }}", $receiver_name, $message);
    $config  = $general->mail_config;

    if ($config->name == 'php') {
        sendPhpMail($email, $receiver_name, $general->email_from, $subject, $message);
    } else if ($config->name == 'smtp') {
        sendSmtpMail($config, $email, $receiver_name,$subject,$message,$general);
    } else if ($config->name == 'sendgrid') {
        sendSendGridMail($config, $email, $receiver_name,$subject, $message,$general);
    } else if ($config->name == 'mailjet') {
        sendMailjetMail($config, $email, $receiver_name,$subject, $message,$general);
    }
}

function getContent($data_keys, $singleQuery = false, $limit = null,$orderById = false)
{
    if ($singleQuery) {
        $content = Frontend::where('data_keys', $data_keys)->latest()->first();
    } else {
        $article = Frontend::query();
        $article->when($limit != null, function ($q) use ($limit) {
            return $q->limit($limit);
        });
        if($orderById){
            $content = $article->where('data_keys', $data_keys)->orderBy('id')->get();
        }else{
            $content = $article->where('data_keys', $data_keys)->latest()->get();
        }
    }
    return $content;
}


function gatewayRedirectUrl(){
    return 'user.deposit';
}

function paginateLinks($data, $design = 'admin.partials.paginate'){
    return $data->appends(request()->all())->links($design);
}

function printEmail($email)
{
    $beforeAt = strstr($email, '@', true);
    $withStar = substr($beforeAt, 0, 2) . str_repeat("**", 5) . substr($beforeAt, -2) . strstr($email, '@');
    return $withStar;
}

/* MLM FUNCTION  */

function getUserById($id)
{
    return User::find($id);
}
function MenusList($id,$value)
{
  $menus = Menu::where('id',$id)->first();
  if($menus){
        return $menus->$value;
    }else{
        return NULL;
    }
}
if (!function_exists('treeComission')) {
    function treeComission($userId, $amount, $remark = 'plan_purchase', $recipientId = null)
    {
        $gnl = GeneralSetting::first();
        $fromUser = User::find($userId);
        $recipient = User::find($recipientId);

        if (!$fromUser || !$recipient) {
            return false;
        }

        $details = ($remark == 'plan_purchase')
            ? $fromUser->username . ' Subscribed the plan and ' . $amount . $gnl->cur_text . ' Commission is transferred.'
            : $fromUser->username . ' Invested and ' . $amount . $gnl->cur_text . ' Indirect Commission is transferred.';

        if ($recipient->plan_id != 0 && $recipient->plan_type != 5 && $fromUser->plan_type != 5) {
            $recipient->balance += $amount;
            if ($remark == 'plan_purchase_indirect') {
                $recipient->total_indir_com += $amount;
            } else {
                $recipient->total_binary_com += $amount;
            }
            $recipient->save();

            $trxID = getTrx();
            $recipient->transactions()->create([
                'amount' => $amount,
                'charge' => 0,
                'trx_type' => '+',
                'details' => $details,
                'remark' => $remark == 'plan_purchase_indirect' ? 'indirect_commission' : 'binary_commission',
                'trx' => $trxID,
                'post_balance' => getAmount($recipient->balance),
            ]);

            /*notify($recipient, 'referral_commission', [
                'trx' => $trxID,
                'amount' => getAmount($amount),
                'currency' => $gnl->cur_text,
                'username' => $recipient->username,
                'post_balance' => getAmount($recipient->balance),
            ]);*/
        }
    }
}
/**Tree Sale**/
function treeSale($id,$amount,$level,$type=null)
{
    $levelName = 'level'.$level.'_parent';
    if (isUserExists($id)) {
        $gnl = GeneralSetting::first();
        $fromUser = User::find($id);
        $posUser = User::find($fromUser->$levelName);
        if (!$posUser) {
            return false;
        }
        if($type=='plan_purchase'){
        $details = $fromUser->username . ' Subscribed the plan and '.$amount.$gnl->cur_text.' sale is added.';
        }else{
         $details = $fromUser->username . ' Invested and '.$amount.$gnl->cur_text.' sale is added.';
        }
        if ($posUser->plan_id != 0 && $posUser->plan_type==1 && $fromUser->plan_type==1 && $posUser->membership_id >= $level) {
            $posUser->total_sale += $amount;
            $posUser->save();
            $trxID = getTrx();
            $posUser->transactions()->create([
                'amount' => 0,
                'charge' => 0,
                'trx_type' => '+',
                'details' => $details,
                'remark' => 'binary_sale',
                'trx' => $trxID,
                'post_balance' => getAmount($posUser->balance),
            ]);
        }
    }
}
/*
===============TREEE===============
*/
function showTreePage($id)
{
    $res['a'] = User::find($id);
    $treeUsers = User::where('ref_id', $id)->get();
    if(isset($treeUsers[0])){
      $res['h'] =  $treeUsers[0];
    }else{
        $res['h'] =null;
    }
    if(isset($treeUsers[1])){
      $res['i'] =  $treeUsers[1];
    }else{
        $res['i'] =null;
    }
    if(isset($treeUsers[2])){
      $res['j'] =  $treeUsers[2];
    }else{
        $res['j'] =null;
    }
    return $res;
}


function showSingleUserinTree($user,$position=null)
{
    $res = '';
    $general = GeneralSetting::first();
    if($user){
        if($user->membership_id > 0){
            $level1 = User::where('level1_parent',$user->id)->count();
        }else{
            $level1=0;
        }
        if($user->membership_id > 1){
            $level2 = User::where('level2_parent',$user->id)->count();
        }else{
            $level2=0;
        }
        if($user->membership_id > 2){
            $level3 = User::where('level3_parent',$user->id)->count();
        }else{
            $level3=0;
        }
        if($user->membership_id > 3){
            $level4 = User::where('level4_parent',$user->id)->count();
        }else{
            $level4=0;
        }
        if($user->membership_id > 4){
            $level5 = User::where('level5_parent',$user->id)->count();
        }else{
            $level5=0;
        }
        if($user->membership_id > 5){
            $level6 = User::where('level6_parent',$user->id)->count();
        }else{
            $level6=0;
        }
        if($user->membership_id > 6){
            $level7 = User::where('level7_parent',$user->id)->count();
        }else{
            $level7=0;
        }
    }else{
      $level1 = 0;
      $level2 = 0;
      $level3 = 0;
      $level4 = 0;
      $level5 = 0;
      $level6 = 0;
      $level7 = 0;
    }
    $levelall = $level1+$level2+$level3+$level4+$level5+$level6+$level7;
    if ($user) {
        if ($user->plan_id == 0) {
            $userType = "free-user";
            $stShow = "Un Paid";
            $planName = '';
            $planType = 'NA';
        } else {
            $userType = "paid-user";
            $stShow = "Paid";
            $planName = $user->plan->name;
            if($user->plan_type==1){
                $planType = '12 Months';
            }else if($user->plan_type==0){
                $planType = '1 Months';
            }else{
              $planType = 'No Plan';
            }
        }

        $img = getImage('assets/images/user/profile/'. $user->image, null, true);

        $refby = getUserById($user->ref_id)->fullname ?? '';
        if (auth()->guard('admin')->user()) {
            $hisTree = route('admin.users.other.tree', $user->username);
        } else {
            $hisTree = route('user.other.tree', $user->username);
        }
        $extraData = " data-name=\"$user->fullname\"";
        $extraData .= " data-treeurl=\"$hisTree\"";
        $extraData .= " data-status=\"$stShow\"";
        $extraData .= " data-plan=\"$planName\"";
        $extraData .= " data-duration=\"$planType\"";
        $extraData .= " data-sale=\"$user->total_sale $general->cur_text\"";
        $extraData .= " data-image=\"$img\"";
        $extraData .= " data-refby=\"$refby\"";
        if($user->membership_id == 1){
        $extraData .= " data-level1=\"$level1\"";
        }
        else if($user->membership_id == 2){
        $extraData .= " data-level1=\"$level1\"";
        $extraData .= " data-level2=\"$level2\"";
        }
        else if($user->membership_id == 3){
        $extraData .= " data-level1=\"$level1\"";
        $extraData .= " data-level2=\"$level2\"";
        $extraData .= " data-level3=\"$level3\"";
        }
        else if($user->membership_id == 4){
        $extraData .= " data-level1=\"$level1\"";
        $extraData .= " data-level2=\"$level2\"";
        $extraData .= " data-level3=\"$level3\"";
        $extraData .= " data-level4=\"$level4\"";
        }
        else if($user->membership_id == 5){
        $extraData .= " data-level1=\"$level1\"";
        $extraData .= " data-level2=\"$level2\"";
        $extraData .= " data-level3=\"$level3\"";
        $extraData .= " data-level4=\"$level4\"";
        $extraData .= " data-level5=\"$level5\"";
        }
        else if($user->membership_id == 6){
        $extraData .= " data-level1=\"$level1\"";
        $extraData .= " data-level2=\"$level2\"";
        $extraData .= " data-level3=\"$level3\"";
        $extraData .= " data-level4=\"$level4\"";
        $extraData .= " data-level5=\"$level5\"";
        $extraData .= " data-level6=\"$level6\"";
        }
        else if($user->membership_id == 7){
        $extraData .= " data-level1=\"$level1\"";
        $extraData .= " data-level2=\"$level2\"";
        $extraData .= " data-level3=\"$level3\"";
        $extraData .= " data-level4=\"$level4\"";
        $extraData .= " data-level5=\"$level5\"";
        $extraData .= " data-level6=\"$level6\"";
        $extraData .= " data-level7=\"$level7\"";
        }
        $extraData .= " data-levelall=\"$levelall\"";
        $res .= "<div class=\"user showDetails\" type=\"button\" $extraData>";
        $res .= "<img src=\"$img\" alt=\"*\"  class=\"$userType\">";
        $res .= "<p class=\"user-name\">$user->username</p>";

    } else {
        $img = getImage('assets/images/user/profile/', null, true);

        $res .= "<div class=\"user\" type=\"button\">";
        $res .= "<img src=\"$img\" alt=\"*\"  class=\"no-user\">";
        $res .= "<p class=\"user-name\">No user</p>";
    }

    $res .= " </div>";
    if($position==1){
        $res .= " <span class=\"line\"></span>";
    }

    return $res;

}

/*
===============TREE AUTH==============
*/
function treeAuth($treeUserID, $loginUserID,$cond=null){
    if($treeUserID==$loginUserID){
        return true;
    }
    if (auth()->guard('admin')->user() && $cond!='user') {
            return true;
        } else {
            if(isUserExistsLevel($treeUserID,$loginUserID)==true){
                return true;
            }
        }
    return 0;
}
function isUserExistsLevel($Tid,$id){
    $membership = User::find($id)->first();
    $user = User::where('id',$Tid)->where(function($query) use($id,$membership) {
        if($membership->membership_id==1){
         $query->where('level1_parent', $id);
        }else if($membership->membership_id==2){
         $query->where('level1_parent', $id)
         ->orWhere('level2_parent',$id);
        }else if($membership->membership_id==3){
         $query->where('level1_parent', $id)
         ->orWhere('level2_parent',$id)
         ->orWhere('level3_parent',$id);
        }else if($membership->membership_id==4){
         $query->where('level1_parent', $id)
         ->orWhere('level2_parent',$id)
         ->orWhere('level3_parent',$id)
         ->orWhere('level4_parent',$id);
        }else if($membership->membership_id==5){
         $query->where('level1_parent', $id)
         ->orWhere('level2_parent',$id)
         ->orWhere('level3_parent',$id)
         ->orWhere('level4_parent',$id)
         ->orWhere('level5_parent',$id);
        }else if($membership->membership_id==6){
         $query->where('level1_parent', $id)
         ->orWhere('level2_parent',$id)
         ->orWhere('level3_parent',$id)
         ->orWhere('level4_parent',$id)
         ->orWhere('level5_parent',$id)
         ->orWhere('level6_parent',$id);
        }else if($membership->membership_id==7){
        $query->where('level1_parent', $id)
          ->orWhere('level2_parent',$id)
          ->orWhere('level3_parent',$id)
          ->orWhere('level4_parent',$id)
          ->orWhere('level5_parent',$id)
          ->orWhere('level6_parent',$id)
          ->orWhere('level7_parent',$id);
        }
})->first();
    if($user){
            return true;
        }else{
            return false;
        }
}
function isUserExists($id)
{
    $user = User::find($id);
    if ($user) {
        return true;
    } else {
        return false;
    }
}
function displayRating($val)
{
    $result = '';
    for($i=0; $i<intval($val); $i++){
        $result .= '<i class="la la-star text--warning"></i>';
    }
    if(fmod($val, 1)==0.5){
        $i++;
        $result .='<i class="las la-star-half-alt text--warning"></i>';
    }
    for($k=0; $k<5-$i ; $k++){
        $result .= '<i class="lar la-star text--warning"></i>';
    }
    return $result;
}
function isUserPiad(){
    $user = Auth()->user();
    if ($user->plan_type < 5) {
        return true;
    } else {
        return false;
    }
}
function crypt_widget(){
    $general = GeneralSetting::first();
    if($general->cryp_widget==1){
        return true;
    }else{
        return false;
    }
}
function cryp_calculator(){
    $general = GeneralSetting::first();
    if($general->cryp_calculator==1){
        return true;
    }else{
        return false;
    }
}
