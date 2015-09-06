<?php
namespace Vdemo\Controller\Front;

class DemoController extends \Vine\Component\Controller\BaseController
{/*{{{*/
    private $demoSvc = null; 


    public function beforeAction()
    {/*{{{*/
        parent::beforeAction();

        $this->demoSvc = \Vdemo\AppContainer::getInstance()->getSqlSvc('Demo');
    }/*}}}*/

    public function indexAction()
    {/*{{{*/
        $total    = $this->demoSvc->selectTotalByParamsForFront($this->actionParams);
        $pageObj  = new \Vdemo\Lib\PageObj($this->actionParams['pageno'], $total);
        $pageData = $pageObj->getPageData($this->request->getUrl()->getAbsoluteUrl());
        $this->assign('pageData', $pageData);

        $demoData = $this->demoSvc->selectByParamsForFront($this->actionParams, $pageObj->getRowBgn(), $pageObj->getRowCnt());
        $this->assign('demoData', $demoData);

        return $this->autoRender();
    }/*}}}*/
    public function addAction()
    {/*{{{*/
        return $this->autoRender();
    }/*}}}*/
    public function addEntityAction()
    {/*{{{*/
        $this->demoSvc->insert($this->actionParams);

        return \Vdemo\Lib\ApiResponseFactory::getSuccessResponse(array(), '添加成功', $this->request);
    }/*}}}*/
    public function editAction()
    {/*{{{*/
        $demoItem = $this->demoSvc->selectById($this->actionParams['id']);

        $this->assign('demoItem', $demoItem);

        return $this->autoRender();
    }/*}}}*/
    public function editEntityAction()
    {/*{{{*/
        $this->demoSvc->update($this->actionParams);

        return \Vdemo\Lib\ApiResponseFactory::getSuccessResponse(array(), '编辑成功', $this->request);
    }/*}}}*/
    public function delAction()
    {/*{{{*/
        $this->demoSvc->deleteById($this->actionParams['id']);

        return \Vdemo\Lib\ApiResponseFactory::getSuccessResponse(array(), '删除成功', $this->request);
    }/*}}}*/


    protected function setIndexActionParamsConf($conf)
    {/*{{{*/
        $this->setParamNameForIndex($conf);
        $this->setParamPageno($conf);
    }/*}}}*/
    protected function setAddEntityActionParamsConf($conf)
    {/*{{{*/
        $this->setParamName($conf);
    }/*}}}*/
    protected function setEditActionParamsConf($conf)
    {/*{{{*/
        $this->setParamId($conf);
    }/*}}}*/
    protected function setEditEntityActionParamsConf($conf)
    {/*{{{*/
        $this->setParamId($conf);
        $this->setParamName($conf);
    }/*}}}*/
    protected function setDelActionParamsConf($conf)
    {/*{{{*/
        $this->setParamId($conf);
    }/*}}}*/

    private function setParamName($conf)
    {/*{{{*/
        $name = 'name';

        $conf->setParamType($name, \Vine\Component\Validator\Validator::TYPE_STR);
        $conf->setParamDefaultValue($name, '');

        $conf->setParamCheckFunc($name, array('\Vine\Component\Validator\Checker', 'strNotNull'));
        $conf->setParamExceptionParams($name, 'name不正确', \Vdemo\Lib\Error\Errno::E_DEMO_INVALID_NAME);
    }/*}}}*/
    private function setParamNameForIndex($conf)
    {/*{{{*/
        $name = 'name';

        $conf->setParamType($name, \Vine\Component\Validator\Validator::TYPE_STR);
        $conf->setParamDefaultValue($name, null);
        $conf->setParamFilterNull($name);
    }/*}}}*/
    private function setParamId($conf)
    {/*{{{*/
        $name = 'id';

        $conf->setParamType($name, \Vine\Component\Validator\Validator::TYPE_NUM);
        $conf->setParamDefaultValue($name, 0);

        $conf->setParamCheckFunc($name, array('\Vine\Component\Validator\Checker', 'numNotZero'));
        $conf->setParamExceptionParams($name, 'id不正确', \Vdemo\Lib\Error\Errno::E_DEMO_INVALID_ID);
    }/*}}}*/
    private function setParamPageno($conf)
    {/*{{{*/
        $name = 'pageno';

        $conf->setParamType($name, \Vine\Component\Validator\Validator::TYPE_NUM);
        $conf->setParamDefaultValue($name, 1);
    }/*}}}*/
}/*}}}*/
