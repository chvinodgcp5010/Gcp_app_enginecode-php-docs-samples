<?php
/**
 * Copyright 2018 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * For instructions on how to run the full sample:
 *
 * @see https://github.com/GoogleCloudPlatform/php-docs-samples/tree/master/firestore/README.md
 */

namespace Google\Cloud\Samples\Firestore;

use Google\Cloud\Firestore\FirestoreClient;

/**
 * Retrieve all documents from a collection.
 *
 * @param string $projectId The Google Cloud Project ID
 */
function setup_dataset_read(string $projectId): void
{
    // Create the Cloud Firestore client
    $db = new FirestoreClient([
        'projectId' => $projectId,
    ]);
    # [START firestore_setup_dataset_read]
    $usersRef = $db->collection('samples/php/users');
    $snapshot = $usersRef->documents();
    foreach ($snapshot as $user) {
        printf('User: %s' . PHP_EOL, $user->id());
        printf('First: %s' . PHP_EOL, $user['first']);
        if (!empty($user['middle'])) {
            printf('Middle: %s' . PHP_EOL, $user['middle']);
        }
        printf('Last: %s' . PHP_EOL, $user['last']);
        printf('Born: %d' . PHP_EOL, $user['born']);
        printf(PHP_EOL);
    }
    printf('Retrieved and printed out all documents from the users collection.' . PHP_EOL);
    # [END firestore_setup_dataset_read]
}

// The following 2 lines are only needed to run the samples
require_once __DIR__ . '/../../testing/sample_helpers.php';
\Google\Cloud\Samples\execute_sample(__FILE__, __NAMESPACE__, $argv);
