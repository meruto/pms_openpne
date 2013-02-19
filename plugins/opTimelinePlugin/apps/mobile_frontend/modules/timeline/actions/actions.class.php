<?php

/**
* This file is part of the OpenPNE package.
* (c) OpenPNE Project (http://www.openpne.jp/)
*
* For the full copyright and license information, please view the LICENSE
* file and the NOTICE file that were distributed with this source code.
*/

/**
* opMemberAction
*
* @package    OpenPNE
* @subpackage action
* @author     tatsuya ichikawa <ichikawa@tejimaya.com>
*/
class timelineActions extends opTimelineAction
{
  public function preExecute()
  {
    $this->id = $this->getRequestParameter('id', $this->getUser()->getMemberId());
  }

  public function executeDeleteTimeline($request)
  {
    $this->forward404Unless($request->hasParameter('id'));

    $this->activity = Doctrine::getTable('ActivityData')->find($this->id);
    $this->forward404Unless($this->activity instanceof ActivityData);
    $this->forward404Unless($this->activity->getMemberId() == $this->getUser()->getMemberId());

    if ($request->isMethod(sfWebRequest::POST))
    {   
      $request->checkCSRFProtection();
      $this->activity->delete();
      $this->getUser()->setFlash('notice', 'An %activity% was deleted.');
      $this->redirect('@homepage');
    }     
  }

  public function executeComment($request)
  {
    $this->forward404Unless($request->hasParameter('id'));

    $this->activity = Doctrine::getTable('ActivityData')->find($this->id);
    $this->forward404Unless($this->activity instanceof ActivityData);

    $this->form = new TimelineDataForm();
    $this->form->setDefault('in_reply_to_activity_id', $this->id);
    $this->form->setDefault('public_flag', $this->activity->getPublicFlag());
  }

  public function executeUpdateTimeline($request)
  {
    if ($request->isMethod(sfWebRequest::POST))
    {   
      $this->forward404Unless(opConfig::get('is_allow_post_activity'));
      parent::updateTimeline($request);
    }
  }

  public function executeSns(sfWebRequest $request)
  {
    $this->form = new ActivityDataForm();

    $this->size = 15;
    $this->pager = new opNonCountQueryPager('ActivityData', $this->size);
    $q = Doctrine::getTable('ActivityData')->createQuery()
      ->where('public_flag = 1')
      ->andWhere('foreign_table is null')
      ->orderBy('id desc');
    $this->pager->setQuery($q);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }
}
