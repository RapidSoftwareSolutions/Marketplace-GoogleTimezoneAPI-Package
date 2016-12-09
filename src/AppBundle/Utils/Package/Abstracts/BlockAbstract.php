<?php
/**
 * @author Dmitry Shumytskyi <d.shumytskyi@gmail.com>
 */

namespace AppBundle\Utils\Package\Abstracts;

abstract class BlockAbstract
{
    /**
     * @var array
     */
    protected $response;
    /**
     * @var mixed
     */
    protected $parameters;
    /**
     * @var mixed
     */
    protected $httpClient;
    /**
     * @var mixed
     */
    protected $requestBuilder;
    /**
     * @var mixed
     */
    protected $finder;
    /**
     * @var array
     */
    protected $result;

    /**
     * constructor
     *
     * @param $request
     * @param $httpClient
     * @param $requestBuilder
     * @param $finder
     */
    public function __construct($request, $httpClient, $requestBuilder, $finder)
    {
        $this->httpClient = $httpClient;
        $this->requestBuilder = $requestBuilder;
        $this->finder = $finder;
        $this->request = $request->getCurrentRequest();
        $this->body = json_decode(str_replace('\\"', '"', $requestBuilder->normalizeJson($this->request->getContent())), true);
        $this->parameters = $this->body['args'];
    }

    /**
     * return a method to be used as a callback
     *
     * @param $callbackMethod
     * @return array
     */
    public function getCallback($callbackMethod)
    {
        return [$this, $callbackMethod];
    }

    /**
     * @param $schema
     * @return string
     */
    public function prepareRequest($schema)
    {
        $headers = $this->requestBuilder->buildHeaders($schema, $this->parameters);

        $query = $this->requestBuilder->buildArgsParams($schema, $this->parameters);

        $uri = $this->requestBuilder->buildUriParams($schema, $this->parameters);

        if ($schema['content_in_body']) {

            return ['url' => $schema['url'] . $uri, 'body' => $query, 'headers' => $headers];
        } else {

            return ['url' => $schema['url'] . $uri . $query, 'headers' => $headers];
        }
    }

    /**
     * @param $schema
     */
    public function pagination($schema)
    {
        if (
            ($schema['enable_pagination'] == true && $schema['limit_field_stop_pagination'] == false)
            || ($schema['enable_pagination'] == true && $schema['limit_field_stop_pagination'] == true && $this->parameters[$schema['args']['limit']] == '')
        ) {

            $next = $this->finder->recursiveFindValueInMultiArray($this->result, $schema['pagination_next_url_key']);

            while ($next) {

                $pagination = json_decode($this->sendRequest($schema, ['url' => $next]), true);

                $next = $this->finder->recursiveFindValueInMultiArray($pagination, $schema['pagination_next_url_key']);

                $this->result = array_merge_recursive($this->result, $pagination);
            }
        }
    }

    /**
     * @param $schema
     * @param $request
     *
     * @return mixed
     */
    public function sendRequest($schema, $request)
    {
        if ($schema['content_in_body']) {

            $response = $this->httpClient->{$schema['method']}($request['url'], $request['headers'], $request['body']);
        } else {

            $response = $this->httpClient->{$schema['method']}($request['url'], $request['headers']);
        }

        if ($schema['media_response'] !== false) {

            return chunk_split(base64_encode($response->getContent()));
        } else {

            return $response->getContent();
        }
    }

    /**
     * @param $schema
     */
    public function setResponse($schema)
    {
        if ($this->finder->recursiveFindValueInMultiArray($this->result, $schema['error_context']) != 'OK') {

            $this->response = ['callback' => $schema['callback_message']['error'], 'contextWrites' => ['to' => $this->result]];
        } elseif ($this->finder->recursiveFindValueInMultiArray($this->result, $schema['extra_context'])) {

            $this->response = ['callback' => $schema['callback_message']['extra'], 'contextWrites' => ['to' => $this->result]];
        } else {

            $this->response = ['callback' => $schema['callback_message']['success'], 'contextWrites' => ['to' => $this->result]];
        }
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

}