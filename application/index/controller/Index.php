<?php

namespace app\index\controller;

use app\admin\model\cms\Channel;
use app\common\controller\Frontend;
use fast\Http;
use fast\Pinyin;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpZip\ZipFile;
use think\Db;
use think\Env;

class Index extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    public function index()
    {
        return $this->view->fetch();
    }



    public function test(){
        $params['college_name'] = input('college_name');

        $data['diyname'] = Pinyin::get($params['college_name']);
        $data['name']=$params['college_name'];
        $data['channeltpl']='channel_news.html';
        $data['listtpl'] ='list_news.html';
        $data['showtpl'] ='show_notify.html';
        $data['pagesize'] =10;
        $data['iscontribute']=1;
        $data['isnav'] =1;
        $data['status'] ='normal';
        $data['model_id']=5;
        $data['parent_id']=10;
        $data['type']='list';

        $res =  Channel::create($data);
//        $params['channel_id'] =$res->id;

        return json($res);



    }



    public function news()
    {
            $tp = new TemplateProcessor('template/example.docx');
            $tp->setValue('ativity_name','测试活动名称');
            $tp->setValue('activity_time','2019-8-2');
            $tp->setValue('activity_place','厚德楼213');
            $tp->setValue('activity_persion','云中有鹿');
            $tp->setValue('activity_record','小李子');
            $tp->setValue('read_list','张三,李四,王二,小张,小陈');
            $tp->setValue('true_number','12');
            $tp->setValue('false_number','0');
            $html ='<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; caret-color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif;">上党，是秦朝时期秦始皇所设三十六郡之一，因其地居太行之巅，地势最高，故名“上党”，即今山西省长治市一带地区。在元天穆的后裔子孙中，有以先祖封地名称为姓氏者，称党氏，但未入北魏史籍，成为鲜卑族脱谱姓氏之一。后逐渐文化上汉化世代相传至今，其党氏正确读音作dǎng(ㄉㄤˇ)。另外，匈奴族赫连部也有党姓。</div><div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; caret-color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif;"><span style="font-weight: 700;">源流六</span></div><div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; caret-color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif;">源于藏族，出自秦、汉时期的党项民族，属于以氏族名称汉化为氏。</div><div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; caret-color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif;">古代藏族就有自己的姓氏，最初主要有四个姓氏，号称“先藏六姓”，就是“嘎、珠、扎、党、韦、达”六大姓氏，其中的“党”亦称“冬”，这在达仓宗巴班觉松保撰写的《中藏史集》、巴沃祖拉程瓦撰写的《智者喜宴》、智扎喜嘉措撰写的《姓氏白莲苑》等汉、藏文史籍中均有记载。另外在其它一些藏文史籍的记载中，将“色、慕、冬、党”列为原始的四大姓氏，但目前藏学界一般认为色、慕、冬、当都包括在嘎、珠、扎、党四大姓氏之中，是由于刚开始用文字记载时，还没有形成统一的文字规范，因此形成同音但拼写方式不同的现象。</div><div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; caret-color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif;">藏族党姓，或冬姓，就是汉文史书中记载的藏族先民之一的党项民族称谓，据文献《中藏史集》的记载，党项民族在青藏高原一开始分化为党噶、党纳、党查、党姆等，然后以此未基础，再分化为六大且氏、六大曾氏、十八大额氏、十八大查氏、十八大须氏等等，其中的十八大须还包括玉须(今长江源头玉树)、拉须(今青海澜沧江上游拉秀)，其名称和地域至今没有变化。</div><div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; caret-color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif;">该支党氏族人遍布西藏康区、安多等地方，后来由于藏汉之间的争斗，西藏赞普从西藏各地迁移很多部落到康区和安多守戍边界，因此在康区和安多的藏人中包含着各种姓氏的人。这在藏文史籍《五行常用宝瓶》中有记载：“在下部多康地区，党氏五行为土，寄魂于鹿；珠氏五行为水，寄魂于旄牛；扎氏五行为铁，寄魂于野驴；果氏五行为火，寄魂于山羊；嘎氏五行为木，寄魂于绵羊；如若不知详细之姓氏，可均归于党氏”。</div><div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; caret-color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif;">记载中所谓的“寄魂”，是西藏原始宗教本教的一种观念，表明当事西藏多康地区虽然有各姓氏的人，但主体仍是党氏。</div><div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; caret-color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif;">党氏族人中的一部分部族在抗拒西藏统一过程失败后，东迁到中原，其后裔在西藏边界地区建立了藏语所称的“木雅国”，也就是汉文史籍中记载的西夏国，由于木雅国中百姓大多为内地人，受其影响，在蒙古军灭其国后，也就被文化上同化为汉族而不复作为独立民族存在。</div><div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; caret-color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif;">在西藏的六大氏族中，党氏中相当多的族人后来与韦氏、达氏两族在历史长河中几乎全部被汉族或其它少数民族如壮族、回族、满族所融合。在藏语中，党氏读音作dōng(ㄉㄨㄥ)。</div>';
            $html =  strip_tags($html);
            $tp->setValue('contents',$html);
            $tp->setImageValue('images',['uploads/bcc251d2aedf42abc8e3b3863da7325efebdfaca814f4-j1BmLC_fw658tWv9rk3eMHJbGlNU.jpeg','/uploads/锦绣2ydjrBbg7PvpFxYzR.png']
            );
            $tp->setImageValue('images',['/uploads/锦绣2ydjrBbg7PvpFxYzR.png']
           );

            $filename = 'testword.docx';
            $tp->saveAs($filename);
            $name = pathinfo($filename,PATHINFO_FILENAME);
            return Http::sendToBrowser($filename,$name)->expire(0);
   }




//   function removeHTMLTag($html){
/*    $htmlTagReg = '/<(\/)?[^>].*?>/g';*/
//    return $html.replace($htmlTagReg , '');
//}






   public  function test2(){

       $zip = new ZipFile();
       $zip->addFile('uploads/锦绣2ydjrBbg7PvpFxYzR.png','img/测试名字.png');
       $zip->addFile('uploads/锦绣1ewxdSQ8LHBlrFGsV.png','img/测试名字2.png');
//       $zip->addDir('uploads');

       $filename = 'testword.zip';
       $zip->saveAsFile($filename);
       $name = pathinfo($filename,PATHINFO_FILENAME);
       return Http::sendToBrowser($filename,$name)->expire(0);
   }



}
