<?php
namespace console\controllers;

use common\components\rbac\rules\UserRule;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $authManager = \Yii::$app->authManager;
        $authManager->removeAll();

        // Create role
        $user  = $authManager->createRole('user');

        $film  = $authManager->createPermission('film');
        $booking  = $authManager->createPermission('booking');
        $cinemaHall  = $authManager->createPermission('cinema-hall');
        $cinemaHallRows  = $authManager->createPermission('cinema-hall-rows');
        $cinemaHallSeats  = $authManager->createPermission('cinema-hall-seats');

        $logout  = $authManager->createPermission('logout');

        // Add permissions in Yii::$app->authManager
        $authManager->add($film);
        $authManager->add($booking);
        $authManager->add($cinemaHall);
        $authManager->add($cinemaHallRows);
        $authManager->add($cinemaHallSeats);
        $authManager->add($logout);

        // Add user rule
        $userRule = new UserRule();
        $authManager->add($userRule);
        // Add rule "UserRule" in roles
        $user->ruleName = $userRule->name;


        // Add roles in Yii::$app->authManager
        $authManager->add($user);

        // Add permission-per-role in Yii::$app->authManager
        // Guest
        $authManager->addChild($user, $film);
        $authManager->addChild($user, $booking);
        $authManager->addChild($user, $cinemaHall);
        $authManager->addChild($user, $cinemaHallRows);
        $authManager->addChild($user, $cinemaHallSeats);
        $authManager->addChild($user, $logout);

        $authManager->assign($user, 1);
    }
}
