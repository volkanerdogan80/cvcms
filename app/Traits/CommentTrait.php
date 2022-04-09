<?php


namespace App\Traits;


use App\Entities\CommentEntity;
use App\Models\CommentModel;
use App\Models\ContentModel;

trait CommentTrait
{
    public $view_data = [];
    public $comment_id = null;
    public $comment = null;
    public $level;

    public function commentListing($status = null)
    {
        $get_date_filter = $this->request->getGet('dateFilter');
        $date_filter = explode(' - ', $get_date_filter);
        $date_filter = count($date_filter) > 1 ? $date_filter : null;

        $per_page = $this->request->getGet('perPage');
        if (isset($per_page) && $per_page == 0){
            $per_page = null;
        }else{
            $per_page = !empty($per_page) ? $per_page : 20;
        }

        $search = $this->request->getGet('search');
        $search = !empty($search) ? $search : null;

        $content = $this->request->getGet('content');
        $content = !empty($content) ? $content : null;

        $content_model = new ContentModel();
        $user_content_list = [];
        if (!cve_permit_control($this->listing_all_permit)){
            $user_content = $content_model->getContentsByUserId(auth_user_id());
            foreach ($user_content as $item) {
                array_push($user_content_list, $item->id);
            }
        }else{
            $user_content = $content_model->findAll();
        }

        $data = [
            'contents' => $user_content,
            'search' => $search,
            'dateFilter' => $get_date_filter,
            'perPage' => $per_page,
            'content' => $content
        ];

        $comment_model = new CommentModel();
        $get_model = $comment_model->getListing($status, $content, $user_content_list, $search, $date_filter, $per_page);

        if (is_null($status) || $status == strtolower(STATUS_ACTIVE)){
            foreach ($get_model['comments'] as $key => $value) {
                $this->comment_reply = [];
                $value->level = 0;
                array_push($this->comment_list, $value);
                $this->parentComment($value, 1);
                $this->comment_list = array_merge($this->comment_list, $this->comment_reply);
            }

            $get_model['comments'] = $this->comment_list;
        }

        $this->view_data = array_merge($data, $get_model);
        return $this->view_data;
    }

    public function commentReply()
    {
        $data = $this->request->getPost('id');
        $reply = $this->request->getPost('reply');
        $this->level = $this->request->getPost('level');

        $comment_model = new CommentModel();
        $content_model = new ContentModel();
        $comment = $comment_model->find($data);
        $content = $content_model->find($comment->getContentId());

        if ($content->getUserId() != auth_user_id()){
            if (!cve_permit_control($this->reply_all_permit)){
                return $this->response([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'comment_reply_failure')
                ]);
            }
        }

        $comment_entity = new CommentEntity();
        $comment_entity->setName(auth_user_name());
        $comment_entity->setEmail(auth_user_email());
        $comment_entity->setComment($reply);
        $comment_entity->setCommentId($comment->id);
        $comment_entity->setContentId($comment->getContentId());
        $comment_entity->setStatus(STATUS_ACTIVE);

        $this->comment_id = $comment_model->insert($comment_entity);

        if($comment_model->errors()){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'create_failure')
            ]);
        }

        return $this->comment_id;
    }

    public function commentEdit()
    {
        $this->comment_id = $this->request->getPost('id');
        $new_comment = $this->request->getPost('comment');

        $comment_model = new CommentModel();
        $content_model = new ContentModel();
        $comment = $comment_model->find($this->comment_id);
        $content = $content_model->find($comment->getContentId());

        if ($content->getUserId() != auth_user_id()){
            if (!cve_permit_control($this->comment_edit_all)){
                return $this->response([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'comment_edit_failure')
                ]);
            }
        }

        $comment_entity = new CommentEntity();
        $comment_entity->setId($this->comment_id);
        $comment_entity->setComment($new_comment);

        $comment_model->update($this->comment_id, $comment_entity);

        if ($comment_model->errors()){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'update_failure')
            ]);
        }

        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Errors', 'comment_update_success')
        ]);
    }

    public function commentStatus()
    {
        $this->comment_id = $this->request->getPost('id');
        $status = $this->request->getPost('status');

        $comment_model = new CommentModel();
        $content_model = new ContentModel();
        $comment = $comment_model->find($this->comment_id);
        $content = $content_model->find($comment->getContentId());

        if ($content->getUserId() != auth_user_id()){
            if (!cve_permit_control($this->comment_status_all)){
                return $this->response([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'comment_reply_status_failure')
                ]);
            }
        }

        $update = $comment_model->update($this->comment_id, ['status' => $status]);
        if(!$update){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'status_change_failure')
            ]);
        }

        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'status_change_success')
        ]);
    }

    public function commentDelete()
    {
        $this->comment_id = $this->request->getPost('id');

        $comment_model = new CommentModel();
        $content_model = new ContentModel();
        $comment = $comment_model->find($this->comment_id);
        $content = $content_model->find($comment->getContentId());

        if ($content->getUserId() != auth_user_id()){
            if (!cve_permit_control($this->comment_delete_all)){
                return $this->response([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'comment_delete_failure')
                ]);
            }
        }

        $parent = $comment_model->where('comment_id', $comment->id)
            ->update(null, ['comment_id' => $comment->getCommentId()]);

        $delete = $comment_model->delete($this->comment_id);
        if (!$delete){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'delete_failure')
            ]);
        }

        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'delete_success')
        ]);
    }

    public function commentUndoDelete()
    {
        $this->comment_id = $this->request->getPost('id');

        $comment_model = new CommentModel();
        $content_model = new ContentModel();
        $comment = $comment_model->onlyDeleted()->find($this->comment_id);
        $content = $content_model->find($comment->getContentId());

        if ($content->getUserId() != auth_user_id()){
            if (!cve_permit_control($this->comment_undo_delete_all)){
                return $this->response([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'comment_undo_delete_failure')
                ]);
            }
        }

        $update = $comment_model->update($this->comment_id, ['deleted_at' => null]);
        if(!$update){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'undo_delete_failure')
            ]);
        }

        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'undo_delete_success')
        ]);
    }

    public function commentPurgeDelete()
    {
        $this->comment_id = $this->request->getPost('id');

        $comment_model = new CommentModel();
        $content_model = new ContentModel();
        $comment = $comment_model->onlyDeleted()->find($this->comment_id);
        $content = $content_model->find($comment->getContentId());

        if ($content->getUserId() != auth_user_id()){
            if (!cve_permit_control($this->comment_purge_delete_all)){
                return $this->response([
                    'status' => false,
                    'message' => cve_admin_lang('Errors', 'comment_undo_delete_failure')
                ]);
            }
        }

        $purge_delete = $comment_model->delete($this->comment_id, true);
        if(!$purge_delete){
            return $this->response([
                'status' => false,
                'message' => cve_admin_lang('Errors', 'purge_delete_failure')
            ]);
        }

        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'purge_delete_success')
        ]);
    }

    public function commentSend($content_id)
    {
        $name = auth_user_name() ?? $this->request->getPost('name');
        $email = auth_user_email() ?? $this->request->getPost('email');
        $comment = $this->request->getPost('comment');
        $comment_id = $this->request->getPost('comment_id') ?? null;

        $comment_model = new CommentModel();
        $comment_entity = new CommentEntity();
        $comment_entity->setName($name);
        $comment_entity->setEmail($email);
        $comment_entity->setComment($comment);
        $comment_entity->setCommentId($comment_id);
        $comment_entity->setContentId($content_id);
        $comment_entity->setStatus(STATUS_PENDING);

        $comment_model->insert($comment_entity);

        if($comment_model->errors()){
            return $this->response([
                'status' => false,
                'message' => $comment_model->errors()
            ]);
        }

        return $this->response([
            'status' => true,
            'message' => cve_admin_lang('Success', 'comment_create_success')
        ]);
    }

    private function parentComment($comment, $level)
    {
        $comment_model = new CommentModel();
        $parent_list = $comment_model->getCommentsByCommentId($comment->id);

        foreach ($parent_list as $item){
            $item->level = $level;
            array_push($this->comment_reply, $item);
            $this->parentComment($item, $level+1);
        }
    }
}