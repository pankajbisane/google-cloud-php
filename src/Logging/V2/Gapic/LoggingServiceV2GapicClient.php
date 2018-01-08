<?php
/*
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/*
 * GENERATED CODE WARNING
 * This file was generated from the file
 * https://github.com/google/googleapis/blob/master/google/logging/v2/logging.proto
 * and updates to that file get reflected here through a refresh process.
 *
 * EXPERIMENTAL: this client library class has not yet been declared GA (1.0). This means that
 * even though we intent the surface to be stable, we may make backwards incompatible changes
 * if necessary.
 *
 * @experimental
 */

namespace Google\Cloud\Logging\V2\Gapic;

use Google\ApiCore\ApiException;
use Google\ApiCore\GapicClientTrait;
use Google\ApiCore\PathTemplate;
use Google\ApiCore\RetrySettings;
use Google\ApiCore\Transport\TransportInterface;
use Google\ApiCore\ValidationException;
use Google\Api\MonitoredResource;
use Google\Auth\CredentialsLoader;
use Google\Cloud\Logging\V2\DeleteLogRequest;
use Google\Cloud\Logging\V2\ListLogEntriesRequest;
use Google\Cloud\Logging\V2\ListLogEntriesResponse;
use Google\Cloud\Logging\V2\ListLogsRequest;
use Google\Cloud\Logging\V2\ListLogsResponse;
use Google\Cloud\Logging\V2\ListMonitoredResourceDescriptorsRequest;
use Google\Cloud\Logging\V2\ListMonitoredResourceDescriptorsResponse;
use Google\Cloud\Logging\V2\LogEntry;
use Google\Cloud\Logging\V2\WriteLogEntriesRequest;
use Google\Cloud\Logging\V2\WriteLogEntriesResponse;
use Google\Protobuf\GPBEmpty;
use Grpc\Channel;
use Grpc\ChannelCredentials;

/**
 * Service Description: Service for ingesting and querying logs.
 *
 * EXPERIMENTAL: this client library class has not yet been declared GA (1.0). This means that
 * even though we intent the surface to be stable, we may make backwards incompatible changes
 * if necessary.
 *
 * This class provides the ability to make remote calls to the backing service through method
 * calls that map to API methods. Sample code to get started:
 *
 * ```
 * $loggingServiceV2Client = new LoggingServiceV2Client();
 * try {
 *     $formattedLogName = $loggingServiceV2Client->logName('[PROJECT]', '[LOG]');
 *     $loggingServiceV2Client->deleteLog($formattedLogName);
 * } finally {
 *     $loggingServiceV2Client->close();
 * }
 * ```
 *
 * Many parameters require resource names to be formatted in a particular way. To assist
 * with these names, this class includes a format method for each type of name, and additionally
 * a parseName method to extract the individual identifiers contained within formatted names
 * that are returned by the API.
 *
 * @experimental
 */
class LoggingServiceV2GapicClient
{
    use GapicClientTrait;

    /**
     * The name of the service.
     */
    const SERVICE_NAME = 'google.logging.v2.LoggingServiceV2';

    /**
     * The default address of the service.
     */
    const SERVICE_ADDRESS = 'logging.googleapis.com';

    /**
     * The default port of the service.
     */
    const DEFAULT_SERVICE_PORT = 443;

    /**
     * The name of the code generator, to be included in the agent header.
     */
    const CODEGEN_NAME = 'gapic';

    /**
     * The code generator version, to be included in the agent header.
     */
    const CODEGEN_VERSION = '0.0.5';

    private static $projectNameTemplate;
    private static $logNameTemplate;
    private static $pathTemplateMap;

    private static function getClientDefaults()
    {
        return [
            'serviceName' => self::SERVICE_NAME,
            'serviceAddress' => self::SERVICE_ADDRESS,
            'port' => self::DEFAULT_SERVICE_PORT,
            'scopes' => [
                'https://www.googleapis.com/auth/cloud-platform',
                'https://www.googleapis.com/auth/cloud-platform.read-only',
                'https://www.googleapis.com/auth/logging.admin',
                'https://www.googleapis.com/auth/logging.read',
                'https://www.googleapis.com/auth/logging.write',
            ],
            'clientConfigPath' => __DIR__.'/../resources/logging_service_v2_client_config.json',
            'restClientConfigPath' => __DIR__.'/../resources/logging_service_v2_rest_client_config.php',
            'descriptorsConfigPath' => __DIR__.'/../resources/logging_service_v2_descriptor_config.php',
            'versionFile' => __DIR__.'/../../VERSION',
        ];
    }

    private static function getProjectNameTemplate()
    {
        if (null == self::$projectNameTemplate) {
            self::$projectNameTemplate = new PathTemplate('projects/{project}');
        }

        return self::$projectNameTemplate;
    }

    private static function getLogNameTemplate()
    {
        if (null == self::$logNameTemplate) {
            self::$logNameTemplate = new PathTemplate('projects/{project}/logs/{log}');
        }

        return self::$logNameTemplate;
    }

    private static function getPathTemplateMap()
    {
        if (null == self::$pathTemplateMap) {
            self::$pathTemplateMap = [
                'project' => self::getProjectNameTemplate(),
                'log' => self::getLogNameTemplate(),
            ];
        }

        return self::$pathTemplateMap;
    }

    /**
     * Formats a string containing the fully-qualified path to represent
     * a project resource.
     *
     * @param string $project
     *
     * @return string The formatted project resource.
     * @experimental
     */
    public static function projectName($project)
    {
        return self::getProjectNameTemplate()->render([
            'project' => $project,
        ]);
    }

    /**
     * Formats a string containing the fully-qualified path to represent
     * a log resource.
     *
     * @param string $project
     * @param string $log
     *
     * @return string The formatted log resource.
     * @experimental
     */
    public static function logName($project, $log)
    {
        return self::getLogNameTemplate()->render([
            'project' => $project,
            'log' => $log,
        ]);
    }

    /**
     * Parses a formatted name string and returns an associative array of the components in the name.
     * The following name formats are supported:
     * Template: Pattern
     * - project: projects/{project}
     * - log: projects/{project}/logs/{log}.
     *
     * The optional $template argument can be supplied to specify a particular pattern, and must
     * match one of the templates listed above. If no $template argument is provided, or if the
     * $template argument does not match one of the templates listed, then parseName will check
     * each of the supported templates, and return the first match.
     *
     * @param string $formattedName The formatted name string
     * @param string $template      Optional name of template to match
     *
     * @return array An associative array from name component IDs to component values.
     *
     * @throws ValidationException If $formattedName could not be matched.
     * @experimental
     */
    public static function parseName($formattedName, $template = null)
    {
        $templateMap = self::getPathTemplateMap();

        if ($template) {
            if (!isset($templateMap[$template])) {
                throw new ValidationException("Template name $template does not exist");
            }

            return $templateMap[$template]->match($formattedName);
        }

        foreach ($templateMap as $templateName => $pathTemplate) {
            try {
                return $pathTemplate->match($formattedName);
            } catch (ValidationException $ex) {
                // Swallow the exception to continue trying other path templates
            }
        }
        throw new ValidationException("Input did not match any known format. Input: $formattedName");
    }

    /**
     * Constructor.
     *
     * @param array $options {
     *                       Optional. Options for configuring the service API wrapper.
     *
     *     @type string $serviceAddress The domain name of the API remote host.
     *                                  Default 'logging.googleapis.com'.
     *     @type mixed $port The port on which to connect to the remote host. Default 443.
     *     @type Channel $channel
     *           A `Channel` object. If not specified, a channel will be constructed.
     *           NOTE: This option is only valid when utilizing the gRPC transport.
     *     @type ChannelCredentials $sslCreds
     *           A `ChannelCredentials` object for use with an SSL-enabled channel.
     *           Default: a credentials object returned from
     *           \Grpc\ChannelCredentials::createSsl().
     *           NOTE: This option is only valid when utilizing the gRPC transport. Also, if the $channel
     *           optional argument is specified, then this argument is unused.
     *     @type bool $forceNewChannel
     *           If true, this forces gRPC to create a new channel instead of using a persistent channel.
     *           Defaults to false.
     *           NOTE: This option is only valid when utilizing the gRPC transport. Also, if the $channel
     *           optional argument is specified, then this option is unused.
     *     @type CredentialsLoader $credentialsLoader
     *           A CredentialsLoader object created using the Google\Auth library.
     *     @type string[] $scopes A string array of scopes to use when acquiring credentials.
     *                          Defaults to the scopes for the Stackdriver Logging API.
     *     @type string $clientConfigPath
     *           Path to a JSON file containing client method configuration, including retry settings.
     *           Specify this setting to specify the retry behavior of all methods on the client.
     *           By default this settings points to the default client config file, which is provided
     *           in the resources folder. The retry settings provided in this option can be overridden
     *           by settings in $retryingOverride
     *     @type array $retryingOverride
     *           An associative array in which the keys are method names (e.g. 'createFoo'), and
     *           the values are retry settings to use for that method. The retry settings for each
     *           method can be a {@see Google\ApiCore\RetrySettings} object, or an associative array
     *           of retry settings parameters. See the documentation on {@see Google\ApiCore\RetrySettings}
     *           for example usage. Passing a value of null is equivalent to a value of
     *           ['retriesEnabled' => false]. Retry settings provided in this setting override the
     *           settings in $clientConfigPath.
     *     @type callable $authHttpHandler A handler used to deliver PSR-7 requests specifically
     *           for authentication. Should match a signature of
     *           `function (RequestInterface $request, array $options) : ResponseInterface`.
     *     @type callable $httpHandler A handler used to deliver PSR-7 requests. Should match a
     *           signature of `function (RequestInterface $request, array $options) : PromiseInterface`.
     *           NOTE: This option is only valid when utilizing the REST transport.
     *     @type string|TransportInterface $transport The transport used for executing network
     *           requests. May be either the string `rest` or `grpc`. Additionally, it is possible
     *           to pass in an already instantiated transport. Defaults to `grpc` if gRPC support is
     *           detected on the system.
     * }
     * @experimental
     */
    public function __construct($options = [])
    {
        $this->setClientOptions($options + self::getClientDefaults());
    }

    /**
     * Deletes all the log entries in a log.
     * The log reappears if it receives new entries.
     * Log entries written shortly before the delete operation might not be
     * deleted.
     *
     * Sample code:
     * ```
     * $loggingServiceV2Client = new LoggingServiceV2Client();
     * try {
     *     $formattedLogName = $loggingServiceV2Client->logName('[PROJECT]', '[LOG]');
     *     $loggingServiceV2Client->deleteLog($formattedLogName);
     * } finally {
     *     $loggingServiceV2Client->close();
     * }
     * ```
     *
     * @param string $logName Required. The resource name of the log to delete:
     *
     *     "projects/[PROJECT_ID]/logs/[LOG_ID]"
     *     "organizations/[ORGANIZATION_ID]/logs/[LOG_ID]"
     *     "billingAccounts/[BILLING_ACCOUNT_ID]/logs/[LOG_ID]"
     *     "folders/[FOLDER_ID]/logs/[LOG_ID]"
     *
     * `[LOG_ID]` must be URL-encoded. For example,
     * `"projects/my-project-id/logs/syslog"`,
     * `"organizations/1234567890/logs/cloudresourcemanager.googleapis.com%2Factivity"`.
     * For more information about log names, see
     * [LogEntry][google.logging.v2.LogEntry].
     * @param array $optionalArgs {
     *                            Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function deleteLog($logName, $optionalArgs = [])
    {
        $request = new DeleteLogRequest();
        $request->setLogName($logName);

        return $this->startCall(
            'DeleteLog',
            GPBEmpty::class,
            $optionalArgs,
            $request
        )->wait();
    }

    /**
     * ## Log entry resources.
     *
     * Writes log entries to Stackdriver Logging. This API method is the
     * only way to send log entries to Stackdriver Logging. This method
     * is used, directly or indirectly, by the Stackdriver Logging agent
     * (fluentd) and all logging libraries configured to use Stackdriver
     * Logging.
     *
     * Sample code:
     * ```
     * $loggingServiceV2Client = new LoggingServiceV2Client();
     * try {
     *     $entries = [];
     *     $response = $loggingServiceV2Client->writeLogEntries($entries);
     * } finally {
     *     $loggingServiceV2Client->close();
     * }
     * ```
     *
     * @param LogEntry[] $entries Required. The log entries to send to Stackdriver Logging. The order of log
     *                            entries in this list does not matter. Values supplied in this method's
     *                            `log_name`, `resource`, and `labels` fields are copied into those log
     *                            entries in this list that do not include values for their corresponding
     *                            fields. For more information, see the [LogEntry][google.logging.v2.LogEntry] type.
     *
     * If the `timestamp` or `insert_id` fields are missing in log entries, then
     * this method supplies the current time or a unique identifier, respectively.
     * The supplied values are chosen so that, among the log entries that did not
     * supply their own values, the entries earlier in the list will sort before
     * the entries later in the list. See the `entries.list` method.
     *
     * Log entries with timestamps that are more than the
     * [logs retention period](https://cloud.google.com/logging/quota-policy) in the past or more than
     * 24 hours in the future might be discarded. Discarding does not return
     * an error.
     *
     * To improve throughput and to avoid exceeding the
     * [quota limit](https://cloud.google.com/logging/quota-policy) for calls to `entries.write`,
     * you should try to include several log entries in this list,
     * rather than calling this method for each individual log entry.
     * @param array $optionalArgs {
     *                            Optional.
     *
     *     @type string $logName
     *          Optional. A default log resource name that is assigned to all log entries
     *          in `entries` that do not specify a value for `log_name`:
     *
     *              "projects/[PROJECT_ID]/logs/[LOG_ID]"
     *              "organizations/[ORGANIZATION_ID]/logs/[LOG_ID]"
     *              "billingAccounts/[BILLING_ACCOUNT_ID]/logs/[LOG_ID]"
     *              "folders/[FOLDER_ID]/logs/[LOG_ID]"
     *
     *          `[LOG_ID]` must be URL-encoded. For example,
     *          `"projects/my-project-id/logs/syslog"` or
     *          `"organizations/1234567890/logs/cloudresourcemanager.googleapis.com%2Factivity"`.
     *          For more information about log names, see
     *          [LogEntry][google.logging.v2.LogEntry].
     *     @type MonitoredResource $resource
     *          Optional. A default monitored resource object that is assigned to all log
     *          entries in `entries` that do not specify a value for `resource`. Example:
     *
     *              { "type": "gce_instance",
     *                "labels": {
     *                  "zone": "us-central1-a", "instance_id": "00000000000000000000" }}
     *
     *          See [LogEntry][google.logging.v2.LogEntry].
     *     @type array $labels
     *          Optional. Default labels that are added to the `labels` field of all log
     *          entries in `entries`. If a log entry already has a label with the same key
     *          as a label in this parameter, then the log entry's label is not changed.
     *          See [LogEntry][google.logging.v2.LogEntry].
     *     @type bool $partialSuccess
     *          Optional. Whether valid entries should be written even if some other
     *          entries fail due to INVALID_ARGUMENT or PERMISSION_DENIED errors. If any
     *          entry is not written, then the response status is the error associated
     *          with one of the failed entries and the response includes error details
     *          keyed by the entries' zero-based index in the `entries.write` method.
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Logging\V2\WriteLogEntriesResponse
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function writeLogEntries($entries, $optionalArgs = [])
    {
        $request = new WriteLogEntriesRequest();
        $request->setEntries($entries);
        if (isset($optionalArgs['logName'])) {
            $request->setLogName($optionalArgs['logName']);
        }
        if (isset($optionalArgs['resource'])) {
            $request->setResource($optionalArgs['resource']);
        }
        if (isset($optionalArgs['labels'])) {
            $request->setLabels($optionalArgs['labels']);
        }
        if (isset($optionalArgs['partialSuccess'])) {
            $request->setPartialSuccess($optionalArgs['partialSuccess']);
        }

        return $this->startCall(
            'WriteLogEntries',
            WriteLogEntriesResponse::class,
            $optionalArgs,
            $request
        )->wait();
    }

    /**
     * Lists log entries.  Use this method to retrieve log entries from
     * Stackdriver Logging.  For ways to export log entries, see
     * [Exporting Logs](https://cloud.google.com/logging/docs/export).
     *
     * Sample code:
     * ```
     * $loggingServiceV2Client = new LoggingServiceV2Client();
     * try {
     *     $resourceNames = [];
     *     // Iterate through all elements
     *     $pagedResponse = $loggingServiceV2Client->listLogEntries($resourceNames);
     *     foreach ($pagedResponse->iterateAllElements() as $element) {
     *         // doSomethingWith($element);
     *     }
     *
     *     // OR iterate over pages of elements
     *     $pagedResponse = $loggingServiceV2Client->listLogEntries($resourceNames);
     *     foreach ($pagedResponse->iteratePages() as $page) {
     *         foreach ($page as $element) {
     *             // doSomethingWith($element);
     *         }
     *     }
     * } finally {
     *     $loggingServiceV2Client->close();
     * }
     * ```
     *
     * @param string[] $resourceNames Required. Names of one or more parent resources from which to
     *                                retrieve log entries:
     *
     *     "projects/[PROJECT_ID]"
     *     "organizations/[ORGANIZATION_ID]"
     *     "billingAccounts/[BILLING_ACCOUNT_ID]"
     *     "folders/[FOLDER_ID]"
     *
     * Projects listed in the `project_ids` field are added to this list.
     * @param array $optionalArgs {
     *                            Optional.
     *
     *     @type string[] $projectIds
     *          Deprecated. Use `resource_names` instead.  One or more project identifiers
     *          or project numbers from which to retrieve log entries.  Example:
     *          `"my-project-1A"`. If present, these project identifiers are converted to
     *          resource name format and added to the list of resources in
     *          `resource_names`.
     *     @type string $filter
     *          Optional. A filter that chooses which log entries to return.  See [Advanced
     *          Logs Filters](https://cloud.google.com/logging/docs/view/advanced_filters).  Only log entries that
     *          match the filter are returned.  An empty filter matches all log entries in
     *          the resources listed in `resource_names`. Referencing a parent resource
     *          that is not listed in `resource_names` will cause the filter to return no
     *          results.
     *          The maximum length of the filter is 20000 characters.
     *     @type string $orderBy
     *          Optional. How the results should be sorted.  Presently, the only permitted
     *          values are `"timestamp asc"` (default) and `"timestamp desc"`. The first
     *          option returns entries in order of increasing values of
     *          `LogEntry.timestamp` (oldest first), and the second option returns entries
     *          in order of decreasing timestamps (newest first).  Entries with equal
     *          timestamps are returned in order of their `insert_id` values.
     *     @type int $pageSize
     *          The maximum number of resources contained in the underlying API
     *          response. The API may return fewer values in a page, even if
     *          there are additional values to be retrieved.
     *     @type string $pageToken
     *          A page token is used to specify a page of values to be returned.
     *          If no page token is specified (the default), the first page
     *          of values will be returned. Any page token used here must have
     *          been generated by a previous call to the API.
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\ApiCore\PagedListResponse
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function listLogEntries($resourceNames, $optionalArgs = [])
    {
        $request = new ListLogEntriesRequest();
        $request->setResourceNames($resourceNames);
        if (isset($optionalArgs['projectIds'])) {
            $request->setProjectIds($optionalArgs['projectIds']);
        }
        if (isset($optionalArgs['filter'])) {
            $request->setFilter($optionalArgs['filter']);
        }
        if (isset($optionalArgs['orderBy'])) {
            $request->setOrderBy($optionalArgs['orderBy']);
        }
        if (isset($optionalArgs['pageSize'])) {
            $request->setPageSize($optionalArgs['pageSize']);
        }
        if (isset($optionalArgs['pageToken'])) {
            $request->setPageToken($optionalArgs['pageToken']);
        }

        return $this->getPagedListResponse(
            'ListLogEntries',
            $optionalArgs,
            ListLogEntriesResponse::class,
            $request
        );
    }

    /**
     * Lists the descriptors for monitored resource types used by Stackdriver
     * Logging.
     *
     * Sample code:
     * ```
     * $loggingServiceV2Client = new LoggingServiceV2Client();
     * try {
     *
     *     // Iterate through all elements
     *     $pagedResponse = $loggingServiceV2Client->listMonitoredResourceDescriptors();
     *     foreach ($pagedResponse->iterateAllElements() as $element) {
     *         // doSomethingWith($element);
     *     }
     *
     *     // OR iterate over pages of elements
     *     $pagedResponse = $loggingServiceV2Client->listMonitoredResourceDescriptors();
     *     foreach ($pagedResponse->iteratePages() as $page) {
     *         foreach ($page as $element) {
     *             // doSomethingWith($element);
     *         }
     *     }
     * } finally {
     *     $loggingServiceV2Client->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *                            Optional.
     *
     *     @type int $pageSize
     *          The maximum number of resources contained in the underlying API
     *          response. The API may return fewer values in a page, even if
     *          there are additional values to be retrieved.
     *     @type string $pageToken
     *          A page token is used to specify a page of values to be returned.
     *          If no page token is specified (the default), the first page
     *          of values will be returned. Any page token used here must have
     *          been generated by a previous call to the API.
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\ApiCore\PagedListResponse
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function listMonitoredResourceDescriptors($optionalArgs = [])
    {
        $request = new ListMonitoredResourceDescriptorsRequest();
        if (isset($optionalArgs['pageSize'])) {
            $request->setPageSize($optionalArgs['pageSize']);
        }
        if (isset($optionalArgs['pageToken'])) {
            $request->setPageToken($optionalArgs['pageToken']);
        }

        return $this->getPagedListResponse(
            'ListMonitoredResourceDescriptors',
            $optionalArgs,
            ListMonitoredResourceDescriptorsResponse::class,
            $request
        );
    }

    /**
     * Lists the logs in projects, organizations, folders, or billing accounts.
     * Only logs that have entries are listed.
     *
     * Sample code:
     * ```
     * $loggingServiceV2Client = new LoggingServiceV2Client();
     * try {
     *     $formattedParent = $loggingServiceV2Client->projectName('[PROJECT]');
     *     // Iterate through all elements
     *     $pagedResponse = $loggingServiceV2Client->listLogs($formattedParent);
     *     foreach ($pagedResponse->iterateAllElements() as $element) {
     *         // doSomethingWith($element);
     *     }
     *
     *     // OR iterate over pages of elements
     *     $pagedResponse = $loggingServiceV2Client->listLogs($formattedParent);
     *     foreach ($pagedResponse->iteratePages() as $page) {
     *         foreach ($page as $element) {
     *             // doSomethingWith($element);
     *         }
     *     }
     * } finally {
     *     $loggingServiceV2Client->close();
     * }
     * ```
     *
     * @param string $parent Required. The resource name that owns the logs:
     *
     *     "projects/[PROJECT_ID]"
     *     "organizations/[ORGANIZATION_ID]"
     *     "billingAccounts/[BILLING_ACCOUNT_ID]"
     *     "folders/[FOLDER_ID]"
     * @param array $optionalArgs {
     *                            Optional.
     *
     *     @type int $pageSize
     *          The maximum number of resources contained in the underlying API
     *          response. The API may return fewer values in a page, even if
     *          there are additional values to be retrieved.
     *     @type string $pageToken
     *          A page token is used to specify a page of values to be returned.
     *          If no page token is specified (the default), the first page
     *          of values will be returned. Any page token used here must have
     *          been generated by a previous call to the API.
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\ApiCore\PagedListResponse
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function listLogs($parent, $optionalArgs = [])
    {
        $request = new ListLogsRequest();
        $request->setParent($parent);
        if (isset($optionalArgs['pageSize'])) {
            $request->setPageSize($optionalArgs['pageSize']);
        }
        if (isset($optionalArgs['pageToken'])) {
            $request->setPageToken($optionalArgs['pageToken']);
        }

        return $this->getPagedListResponse(
            'ListLogs',
            $optionalArgs,
            ListLogsResponse::class,
            $request
        );
    }
}
