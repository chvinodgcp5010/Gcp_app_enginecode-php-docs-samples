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
 * @see https://github.com/GoogleCloudPlatform/php-docs-samples/tree/master/speech/README.md
 */

namespace Google\Cloud\Samples\Speech;

# [START speech_transcribe_enhanced_model]
use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;

/**
 * @param string $audioFile path to an audio file
 */
function transcribe_enhanced_model(string $audioFile)
{
    // change these variables if necessary
    $encoding = AudioEncoding::LINEAR16;
    $sampleRateHertz = 8000;
    $languageCode = 'en-US';

    // get contents of a file into a string
    $content = file_get_contents($audioFile);

    // set string as audio content
    $audio = (new RecognitionAudio())
        ->setContent($content);

    // set config
    $config = (new RecognitionConfig())
        ->setEncoding($encoding)
        ->setSampleRateHertz($sampleRateHertz)
        ->setLanguageCode($languageCode)
        ->setUseEnhanced(true)
        ->setModel('phone_call');

    // create the speech client
    $client = new SpeechClient();

    // make the API call
    $response = $client->recognize($config, $audio);
    $results = $response->getResults();

    // print results
    foreach ($results as $result) {
        $alternatives = $result->getAlternatives();
        $mostLikely = $alternatives[0];
        $transcript = $mostLikely->getTranscript();
        $confidence = $mostLikely->getConfidence();
        printf('Transcript: %s' . PHP_EOL, $transcript);
        printf('Confidence: %s' . PHP_EOL, $confidence);
    }

    $client->close();
}
# [END speech_transcribe_enhanced_model]

// The following 2 lines are only needed to run the samples
require_once __DIR__ . '/../../testing/sample_helpers.php';
\Google\Cloud\Samples\execute_sample(__FILE__, __NAMESPACE__, $argv);
