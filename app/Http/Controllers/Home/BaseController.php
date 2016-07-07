<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class BaseController extends Controller
{
    var $nodes	= '';
    var $pages = '';
    function __construct() {
        //判断关闭
        if(Config::get('website.site_close') == 'off'){
            //show_error($this->config->item('site_close_msg'),500,'网站关闭');
        }
        $data['items']=$this->db->get('settings')->result_array();
        $data['settings']=array(
            'site_name'=>$data['items'][0]['value'],
            'welcome_tip'=>$data['items'][1]['value'],
            'short_intro'=>$data['items'][2]['value'],
            'show_captcha'=>$data['items'][3]['value'],
            'site_run'=>$data['items'][4]['value'],
            'site_stats'=>$data['items'][5]['value'],
            'site_keywords'=>$data['items'][6]['value'],
            'site_description'=>$data['items'][7]['value'],
            'money_title'=>$data['items'][8]['value'],
            'per_page_num'=>$data['items'][9]['value'],
            'logo'=>$this->config->item('logo')
        );
//
//        //用户相关信息
//        if ($this->session->userdata('uid')) {
//            $userinfo= $this->db->select('notices,messages_unread')->where('uid',$this->session->userdata('uid'))->get('users')->row_array();
//            $data['myinfo']=array(
//                'uid'=>$this->session->userdata('uid'),
//                'username'=>$this->session->userdata('username'),
//                'avatar'=>$this->session->userdata('avatar'),
//                'group_type'=>$this->session->userdata('group_type'),
//                'gid'=>$this->session->userdata('gid'),
//                'group_name'=>$this->session->userdata('group_name'),
//                'is_active'=>$this->session->userdata('is_active'),
//                'favorites'=>$this->session->userdata('favorites'),
//                'follows'=>$this->session->userdata('follows'),
//                'credit'=>$this->session->userdata('credit'),
//                'notices'=>@$userinfo['notices'],
//                'messages_unread'=>@$userinfo['messages_unread'],
//                'lastpost'=>$this->session->userdata('lastpost')
//            );
//        }
//
//        //获取二级目录
//        $data['base_folder'] = $this->config->item('base_folder');
//
//        //底部菜单(单页面)
//        $this->load->model('page_m');
//        $data['page_links'] = $this->page_m->get_page_menu(10,0);
//        //模板目录
//        $data['themes']=base_url('static/'.$this->config->item('themes').'/');
//        //全局输出
//        $this->load->vars($data);
    }
}
