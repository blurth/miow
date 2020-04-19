<?php


namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\Subject as SubjectModel;
class Subject extends BaseController
{
    public function getSubjectByName($name)
    {
        return SubjectModel::getSubjectByName($name);

   }
}