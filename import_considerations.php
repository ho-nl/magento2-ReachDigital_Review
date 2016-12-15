<?php
/**
 * Copyright © 2016 H&O E-commerce specialisten B.V. (http://www.h-o.nl/)
 * See LICENSE.txt for license details.
 */

$source_dbh     = new PDO('mysql:host=127.0.0.1;dbname=voetbalshirtskoning', 'root', 'root');
$source_table   = 'mage_review_detail';

$target_dbh     = new PDO('mysql:host=127.0.0.1;dbname=kingdo2', 'root', 'root');
$target_table   = 'rating_consideration';

$stmt = $target_dbh->prepare("SELECT MAX(`review_id`) FROM `{$target_table}`;");
$stmt->execute();
$lastImportedId = $stmt->fetchColumn() ?: 0;

$stmt = $source_dbh->prepare("SELECT `review_id`, `pros`, `cons` FROM `{$source_table}` WHERE `review_id` > {$lastImportedId};");
$stmt->execute();
$sourceData = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($sourceData as $consideration) {
    $pros = preg_split("/\\r\\n|\\r|\\n/", $consideration['pros']);
    $cons = preg_split("/\\r\\n|\\r|\\n/", $consideration['cons']);

    foreach ($pros as $pro) {
        if (empty($pro)) {
            continue;
        }

        $stmt = $target_dbh->prepare("INSERT INTO `{$target_table}` (`review_id`, `type`, `value`) VALUES ({$consideration['review_id']}, 1, '{$pro}');");
        $stmt->execute();
    }

    foreach ($cons as $con) {
        if (empty($con)) {
            continue;
        }

        $stmt = $target_dbh->prepare("INSERT INTO `{$target_table}` (`review_id`, `type`, `value`) VALUES ({$consideration['review_id']}, 0, '{$con}');");
        $stmt->execute();
    }
}

echo sprintf('Started import with review ID %d.', $lastImportedId + 1);
