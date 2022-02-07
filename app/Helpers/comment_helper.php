<?php

/**
 * Retrieves data for a single comment from the database.
 * @param $params | Condition to use in DB query
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function get_comment(array $params)
{
    $model = new \App\Models\CommentModel();

    return cve_cache(cve_cache_name('get_comment', $params), function () use ($model, $params){
        return $model->where('status', STATUS_ACTIVE)->where($params)->first();
    });
}

/**
 * Retrieves listed comments from the database
 * @param array $params | Condition to use in DB query
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed
 */
function get_comments(array $params)
{
    $model = new \App\Models\CommentModel();
    return cve_cache(cve_cache_name('get_comments', $params), function () use ($model, $params){
        return $model->where('status', STATUS_ACTIVE)->where($params)->findAll();
    });
}

/**
 * Returns the data of a single comment
 * @param null $comment | ID or Comment Entity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_comment($comment = null)
{
    if (is_null($comment)){
        $render = \Config\Services::renderer();
        if (isset($render->getData()['comment'])){
            return $render->getData()['comment'];
        }
        return null;
    }

    if (is_object($comment)){
        return $comment;
    }elseif(is_numeric($comment) || is_integer($comment)){
        return get_comment(['id' => $comment]);
    }else{
        return null;
    }
}

/**
 * Returns comments in a list
 * @param null $params | DB query conditions as Null or Array
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_comments($params = null)
{
    if (is_null($params)){
        $render = \Config\Services::renderer();
        return $render->getData()['comments'];
    }

    if (is_array($params)){
        return  get_comments($params);
    }

    return null;
}

/**
 * Returns the ID of a comment
 * @param null $comment | ID or Comment Entity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_comment_id($comment = null)
{
    if ($data = cve_comment($comment)){
        return  $data->id;
    }
    return null;
}

/**
 * Returns the Parent ID of a comment
 * @param null $comment | ID or Comment Entity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_comment_parent_id($comment = null)
{
    if ($data = cve_comment($comment)){
        return  $data->getCommentId();
    }
    return null;
}

/**
 * Returns the parent information of a comment
 * @param null $comment | ID or Comment Entity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_comment_parent($comment = null)
{
    if ($data = cve_comment(cve_comment_parent_id($comment))){
        return get_comment(['id' => $data->id]);
    }
    return null;
}

/**
 * Returns the content ID of a comment
 * @param null $comment | ID or Comment Entity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_comment_content_id($comment = null)
{
    if ($data = cve_comment($comment)){
        return  $data->getContentId();
    }
    return null;
}

/**
 * Returns the content information of a comment
 * @param null $comment | ID or Comment Entity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_comment_content($comment = null)
{
    if ($data = cve_comment_content_id($comment)){
        return cve_post($data);
    }
    return null;
}

/**
 * Returns the name of the replier for a comment
 * @param null $comment | ID or Comment Entity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_comment_name($comment = null)
{
    if ($data = cve_comment($comment)){
        return  $data->getName();
    }
    return null;
}

/**
 * Returns the email of the replier for a comment
 * @param null $comment | ID or Comment Entity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_comment_email($comment = null)
{
    if ($data = cve_comment($comment)){
        return  $data->getEmail();
    }
    return null;
}

/**
 * Returns a comment for a comment
 * @param null $comment | ID or Comment Entity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_comment_comment($comment = null)
{
    if ($data = cve_comment($comment)){
        return  $data->getComment();
    }
    return null;
}

/**
 * Returns a comment status for a comment
 * @param null $comment | ID or Comment Entity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_comment_status($comment = null)
{
    if ($data = cve_comment($comment)){
        return  $data->getStatus();
    }
    return null;
}

/**
 * Returns the level of a comment.
 * @param null $comment | ID or Comment Entity Object
 * @return null
 */
function cve_comment_level($comment = null)
{
    if ($data = cve_comment($comment)){
        return $data->level;
    }
    return null;
}

/**
 * Returns comment list  and adds levels to the comments
 * @param null $content | ContentID or Content Entity Object
 * @param null $comment | CommentID or Comment Entity Object
 * @param int $level | Initial level
 * @param array $data | Array to which comments are added
 * @return array|mixed
 */
function cve_comments_level($content = null, $comment = null, int $level = 0, array $data = [])
{
    $content_id = cve_post_id($content);
    $comment_id = cve_comment_id($comment);
    $comments = get_comments(['content_id' => $content_id, 'comment_id' => $comment_id]);
    $level++;
    foreach ($comments as $comment) {
        $comment->level = $level;
        $data[] = $comment;
        $data = cve_comments_level($content, $comment, $level, $data);
    }
    return $data;
}

/**
 * Returns the creation date of a comment
 * @param null $comment | ID or Comment Entity Object
 * @return \CodeIgniter\Cache\CacheInterface|false|mixed|null
 */
function cve_comment_created_at($comment = null, $humanize = false)
{
    if ($data = cve_comment($comment)){
        return  $data->getCreatedAt($humanize);
    }
    return null;
}

