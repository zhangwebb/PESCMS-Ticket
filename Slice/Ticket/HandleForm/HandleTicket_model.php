<?php
/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 * @core version 2.6
 * @version 1.0
 */


namespace Slice\Ticket\HandleForm;

/**
 * 处理后台 工单模型添加/编辑提交过来的表单
 * @package Slice\Ticket
 */
class HandleTicket_model extends \Core\Slice\Slice {

    public function before() {

        if(in_array(METHOD, ['POST', 'PUT'])){
            $_POST['group_id'] = ','.implode(',', $_POST['group_id']).',';
        }

        if (METHOD == 'GET') {
            if (!empty($_GET['id'])) {
                $number = $this->g('id');
                $_GET['id'] = \Model\TicketModel::numberFind($number)['ticket_model_id'];
            }
        } elseif (METHOD == 'POST') {
            //统一工单模型的ID号为10个长度
            $_POST['number'] = (string)str_pad(substr(\Model\Extra::getOnlyNumber(), 0, 10), 10, 0, STR_PAD_RIGHT);
        } elseif (METHOD == 'PUT' || METHOD == 'DELETE') {
            if(METHOD == 'PUT'){
                $func = 'isP';
            }else{
                $func = 'isG';
            }
            $_POST['number'] = $_GET['number'] = $number = $this->$func('id', '请提交您要编辑的工单ID');
            $content = \Model\TicketModel::numberFind($number);
            $_POST['id'] = $_GET['id'] = (string)$content['ticket_model_id'];
        }

    }

    public function after() {
    }


}