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
 * Create a composite index chained query, which combines an equality operator with a range comparison. You will need to
 * create a custom index. @see https://cloud.google.com/firestore/docs/query-data/indexing.
 *
 * @param string $projectId The Google Cloud Project ID
 */
function query_filter_compound_multi_eq_lt(string $projectId): void
{
    // Create the Cloud Firestore client
    $db = new FirestoreClient([
        'projectId' => $projectId,
    ]);
    $citiesRef = $db->collection('samples/php/cities');
    # [START firestore_query_filter_compound_multi_eq_lt]
    $chainedQuery = $citiesRef
        ->where('state', '=', 'CA')
        ->where('population', '<', 1000000);
    # [END firestore_query_filter_compound_multi_eq_lt]
    foreach ($chainedQuery->documents() as $document) {
        printf('Document %s returned by query state=CA and population<1000000' . PHP_EOL, $document->id());
    }
}

// The following 2 lines are only needed to run the samples
require_once __DIR__ . '/../../testing/sample_helpers.php';
\Google\Cloud\Samples\execute_sample(__FILE__, __NAMESPACE__, $argv);
