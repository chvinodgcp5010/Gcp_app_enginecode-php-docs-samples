<?php
/**
 * Copyright 2016 Google Inc.
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
 * @see https://github.com/GoogleCloudPlatform/php-docs-samples/tree/master/translate/README.md
 */

namespace Google\Cloud\Samples\Translate;

// [START translate_text_with_model]
use Google\Cloud\Translate\TranslateClient;

/**
 * @param string $text The text to translate.
 * @param string $targetLanguage Language to translate to.
 */
function translate_with_model(string $text, string $targetLanguage): void
{
    $model = 'nmt';  // "base" for standard edition, "nmt" for premium
    $translate = new TranslateClient();
    $result = $translate->translate($text, [
        'target' => $targetLanguage,
        'model' => $model,
    ]);
    print("Source language: $result[source]\n");
    print("Translation: $result[text]\n");
    print("Model: $result[model]\n");
}
// [END translate_text_with_model]

// The following 2 lines are only needed to run the samples
require_once __DIR__ . '/../../testing/sample_helpers.php';
\Google\Cloud\Samples\execute_sample(__FILE__, __NAMESPACE__, $argv);
