<?php
/**
 * Created by PhpStorm.
 * User: Sergio
 * Date: 07.09.2019
 * Time: 22:22
 */

namespace app\components;


use app\rules\ViewDataOwnerRule;
use yii\base\Component;

class RbacComponent extends Component
{
    public function generateRbacRules()
    {
        $authManager = \Yii::$app->authManager;

        $authManager->removeAll():

        $admin = $authManager->createRole('admin');
        $user = $authManager->createRole('user');

        $authManager->add($admin);
        $authManager->add($user);

        /*$viewOwnerRule = new ViewDataOwnerRule();
        $authManager->add($viewOwnerRule);*/


        $createData = $authManager->createPermission('createData');
        $createData->description = 'Внесение личных данных';

        $viewData = $authManager->createPermission('viewData');
        $viewData->description = 'Просмотр личных данных';
        /*$viewData->ruleName = $viewOwnerRule->name;*/

        $viewEditAll = $authManager->createPermission('viewEditAll');
        $viewEditAll->description = 'Просмотр и редактирование всех данных';

        $authManager->add($createData);
        $authManager->add($viewData);
        $authManager->add($viewEditAll);

        $authManager->addChild($user, $createData);
        $authManager->addChild($user, $viewData);
        $authManager->addChild($admin, $user);
        $authManager->addChild($admin, $viewEditAll);

        $authManager->assign($user, 3);
        $authManager->assign($admin, 4);
    }

    public function addRole($id)
    {
        $authManager = $this->getAuthManager();
        $user = $authManager->createRole('user');
        $authManager->assign($user, $id);
    }

    public function canCreateData()
    {
        return \Yii::$app->user->can('createData');
    }

    public function canViewEditAll()
    {
        return \Yii::$app->user->can('viewEditAll');
    }

    public function canViewData($data):bool
    {
        return \Yii::$app->user->can('viewData', ['data' => $data]);
    }
}