<?php

namespace App\Controllers\Backend;
use \App\Controllers\BaseController;
use App\Entities\CommentEntity;
use App\Models\CommentModel;
use App\Models\ContentModel;

class Comments extends BaseController
{
    protected $contentModel;
    protected $commentModel;
    protected $commentEntity;
    protected $comment_list;
    protected $comment_reply;

    public function __construct()
    {
        $this->contentModel = new ContentModel();
        $this->commentModel = new CommentModel();
        $this->commentEntity = new CommentEntity();
        $this->comment_list = [];
        $this->comment_reply = [];
    }

    public function listing(string $status = null)
    {
        $getDateFilter = $this->request->getGet('dateFilter');
        $dateFilter = explode(' - ', $getDateFilter);
        $dateFilter = count($dateFilter) > 1 ? $dateFilter : null;

        $perPage = $this->request->getGet('perpage');
        $perPage = !empty($perPage) ? $perPage : 20;

        $search = $this->request->getGet('search');
        $search = !empty($search) ? $search : null;

        $content = $this->request->getGet('content');
        $content = !empty($content) ? $content : null;

        $user_content_list = [];
        if(!cve_permit_control('admin_comment_listing_all')){
            $user_content = $this->contentModel->where('user_id', session('userData.id'))->findAll();
            foreach ($user_content as $item){
                array_push($user_content_list, $item->id);
            }
        }else{
            $user_content = $this->contentModel->findAll();
        }

        $data = [
            'contents'  => $user_content,
            'search'    => $search,
            'dateFilter' => $getDateFilter,
            'perPage'   => $perPage,
            'content'   => $content
        ];

        $getModel = $this->commentModel->getListing($status, $content, $user_content_list, $search, $dateFilter, $perPage);

        if (is_null($status) || $status == strtolower(STATUS_ACTIVE)){
            foreach ($getModel['comments'] as $key => $value) {
                $this->comment_reply = [];
                $value->level = 0;
                array_push($this->comment_list, $value);
                $this->parentComment($value, 1);
                $this->comment_list = array_merge($this->comment_list, $this->comment_reply);
            }

            $getModel['comments'] = $this->comment_list;
        }

        $data = array_merge($data, $getModel);

        return view( PANEL_FOLDER .'/pages/comment/listing', $data);
    }

    public function edit()
    {

        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');
            $edited_comment = $this->request->getPost('comment');

            $comment = $this->commentModel->find($data);
            $content = $this->contentModel->find($comment->getContentId());

            if ($content->getUserId() != session('userData.id')){
                if(!cve_permit_control('admin_comment_edit_all')){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang('Errors', 'comment_edit_failure')
                    ]);
                }
            }

            $this->commentEntity->setId($data);
            $this->commentEntity->setComment($edited_comment);
            $this->commentModel->update($data, $this->commentEntity);

            if($this->commentModel->errors()){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'update_failure')
                ]);
            }
            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang('Success', 'update_success')
            ]);
        }
        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang('Errors', 'update_failure')
        ]);
    }

    public function status()
    {
        if($this->request->isAJAX()){

            $data = $this->request->getPost('id');
            $status = $this->request->getPost('status');
            $comment = $this->commentModel->find($data);
            $content = $this->contentModel->find($comment->getContentId());

            if ($content->getUserId() != session('userData.id')){
                if(!cve_permit_control('admin_blog_status_all')){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang('Errors', 'comment_reply_status_failure')
                    ]);
                }
            }

            $update = $this->commentModel->update($data, ['status' => $status]);
            if(!$update){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'status_change_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang('Success', 'status_change_success')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang('Errors', 'status_change_failure')
        ]);
    }

    public function delete()
    {
        if($this->request->isAJAX()){

            $data = $this->request->getPost('id');
            $comment = $this->commentModel->find($data);
            $content = $this->contentModel->find($comment->getContentId());

            if ($content->getUserId() != session('userData.id')){
                if(!cve_permit_control('admin_blog_delete_all')){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang('Errors', 'comment_reply_status_failure')
                    ]);
                }
            }

            $parent = $this->commentModel->where('comment_id', $comment->id)
                ->update(null, ['comment_id' => $comment->getCommentId()]);

            $delete = $this->commentModel->delete($data);
            if (!$delete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'delete_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang('Success', 'delete_success')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang('Errors', 'delete_failure')
        ]);
    }

    public function undoDelete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');

            $comment = $this->commentModel->onlyDeleted()->find($data);
            $content = $this->contentModel->find($comment->getContentId());

            if ($content->getUserId() != session('userData.id')){
                if(!cve_permit_control('admin_comment_undo_delete_all')){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang('Errors', 'comment_undo_delete_failure')
                    ]);
                }
            }

            $update = $this->commentModel->update($data, ['deleted_at' => null]);
            if(!$update){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'comment_undo_delete_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang('Success', 'undo_delete_success')
            ]);

        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang('Errors', 'comment_undo_delete_failure')
        ]);
    }

    public function purgeDelete()
    {
        if($this->request->isAJAX()){
            $data = $this->request->getPost('id');

            $comment = $this->commentModel->onlyDeleted()->find($data);
            $content = $this->contentModel->find($comment->getContentId());

            if ($content->getUserId() != session('userData.id')){
                if(!cve_permit_control('admin_comment_purge_delete_all')){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang('Errors', 'comment_purge_delete_failure')
                    ]);
                }
            }
            $purgeDelete = $this->commentModel->delete($data, true);
            if(!$purgeDelete){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'purge_delete_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang('Success', 'purge_delete_success')
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang('Errors', 'purge_delete_failure')
        ]);
    }

    public function editModal()
    {
        $data = $this->request->getGet('id');
        return view(PANEL_FOLDER . '/pages/comment/edit-modal' , [
            'comment' => $this->commentModel->find($data)
        ]);
    }

    public function replyModal()
    {
        $data = $this->request->getGet('id');
        return view(PANEL_FOLDER . '/pages/comment/reply-modal' , [
            'comment' => $this->commentModel->find($data)
        ]);
    }

    public function reply()
    {
        if ($this->request->isAJAX()){
            $data = $this->request->getPost('id');
            $reply = $this->request->getPost('reply');
            $level = $this->request->getPost('level');

            $comment = $this->commentModel->find($data);
            $content = $this->contentModel->find($comment->getContentId());

            if ($content->getUserId() != session('userData.id')){
                if(!cve_permit_control('admin_comment_reply_all')){
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => cve_admin_lang('Errors', 'comment_reply_failure')
                    ]);
                }
            }

            $this->commentEntity->setName(session('userData.name'));
            $this->commentEntity->setEmail(session('userData.email'));
            $this->commentEntity->setComment($reply);
            $this->commentEntity->setCommentId($comment->id);
            $this->commentEntity->setContentId($comment->getContentId());
            $this->commentEntity->setStatus(STATUS_ACTIVE);

            $insertID = $this->commentModel->insert($this->commentEntity);

            if($this->commentModel->errors()){
                return $this->response->setJSON([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'create_failure')
                ]);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => cve_admin_lang('Success', 'create_success'),
                'comment' => view(PANEL_FOLDER. '/pages/comment/reply-comment', [
                    'comment' => $this->commentModel->find($insertID),
                    'level' => $level+1
                ])
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => cve_admin_lang('Errors', 'invalid_request_type')
        ]);

    }

    private function parentComment($comment, $level)
    {
        $parent_list = $this->commentModel->where('comment_id', $comment->id)->orderBy('created_at', 'DESC')->findAll();

        foreach ($parent_list as $item){
            $item->level = $level;
            array_push($this->comment_reply, $item);
            $this->parentComment($item, $level+1);
        }
    }

}