<?php
/**
 * look
 * Created by Alan Maplethorpe PhpStorm.
 * User: mszadm
 * Date: 15/06/2013
 * Time: 08:28
 * To change this template use File | Settings | File Templates.
 */
require_once('PhotoFinder.php');

date_default_timezone_set('Europe/London');

$photofinder = new Photofinder('Hitachi');

$photofinder->createDirArray('/Volumes/Hitachi/CanonPictures/Cannon 600D/DCIM/100CANON');

$photofinder->processFile('list');
