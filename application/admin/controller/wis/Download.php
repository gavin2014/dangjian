<?php
/**
 * Created by 云中有鹿.
 * User: 陈云
 * Blog: http://blog.likecy.cn
 * Date: 2019-08-05
 * Time: 23:40
 */

namespace app\admin\controller\wis;


use app\admin\model\cms\Archives;
use app\common\controller\Backend;
use fast\Http;
use PhpOffice\PhpWord\TemplateProcessor;
use function PHPSTORM_META\elementType;
use PhpZip\ZipFile;
use think\Db;

class Download extends Backend
{
    protected $noNeedLogin =['*'];
    protected $noNeedRight =['*'];


    public function All(){
        $archives_id = input('get.archives_id');
        //获取doc文件
        $archives = Db::name('cms_archives')->where('id',$archives_id)->find();
        $cms_notify = Db::name('cms_notify')->where('id',$archives_id)->find();
        $record = Db::name('wis_activityrecord')->where('notify_id',$archives_id)->find();
        $admin= Db::name('admin')->where('id',$archives['admin_id'])->field(['nickname','user_group_id'])->find();

        $activity_recordname  =$admin['nickname'];
        if (!$archives['user_type']){
            $usercount = Db::name('user')->where('group_id',$admin['user_group_id'])->where('status','=','normal')->where('user_type',$archives['user_type'])->count();
        }else{
            $usercount = Db::name('user')->where('group_id',$admin['user_group_id'])->where('status','=','normal')->count();
        }
        $names=explode(',',$archives['haveread_list']);
        $true_number =count($names);
        $tp = new TemplateProcessor('template/example.docx');
        $tp->setValue('ativity_name',$archives['title']);
        $tp->setValue('activity_time',$cms_notify['activity_time']);
        $tp->setValue('activity_place',$cms_notify['activity_place']);
        $tp->setValue('activity_persion',$cms_notify['activity_person']);
        $tp->setValue('activity_record',$activity_recordname);
        $tp->setValue('read_list',$archives['haveread_list']);
        $tp->setValue('true_number',$true_number);
        $tp->setValue('false_number',($usercount-$true_number)>0?$usercount-$true_number:0);
        $html =  strip_tags($cms_notify['content']);
        $tp->setValue('contents',$html);
        $docfilename = $archives['title'].'.docx';
        $tp->saveAs($docfilename);
        $zip = new ZipFile();
        if($archives['is_user_record']){
          $filesList =  Db::name('wis_study_record')->where('archives_id',$archives_id)->field('experience_files')->select();
          foreach ($filesList as $file)
          {
              if ($file!=''){
                  $filename = Db::name('attachment')->where('url',$file['experience_files'])->field('extparam')->find()['extparam'];
                  $zip->addFile('.'.$file['experience_files'],'心得体会/'.$filename);
              }

          }

        $recordimages=explode(',',$record['actice_images']);
        if($recordimages !=''){
            $count =1;
            foreach ($recordimages as  $images){
                if ($images!='')
                $zip->addFile('.'.$images,'活动图片/图片'.$count++.'.jpg');
            }
        }
        $zip->addFile($docfilename);
        $filename = $archives['title'].'.zip';
        $zip->saveAsFile($filename);
        $name = pathinfo($filename,PATHINFO_FILENAME);
        return Http::sendToBrowser($filename,$name)->expire(0);
        }

        $name = pathinfo($docfilename,PATHINFO_FILENAME);
        return Http::sendToBrowser($docfilename,$name)->expire(0);



    }


}