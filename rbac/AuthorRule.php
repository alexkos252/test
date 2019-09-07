<?php

namespace app\rbac;

use yii\rbac\Rule;

/**
 * Проверяем идентификатор автора uid на соответствие с пользователем, переданным через параметры
 */
class AuthorRule extends Rule
{
    public $name = 'isAuthor';

    /**
     * @param string|int $user the user ID.
     * @param Item $item the role or permission that this rule is associated width.
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        if(!isset($params['post']) && !empty(\Yii::$app->request->get('id'))){
            $postId = \Yii::$app->request->get('id');
            $params['post'] = \app\models\Posts::findOne($postId);
        }
        return isset($params['post']) ? $params['post']->uid == $user : false;
    }
}