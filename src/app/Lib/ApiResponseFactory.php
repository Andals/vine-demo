<?php
/**
* @file ApiResponseFactory.php
* @author ligang
* @date 2015-08-25
 */

namespace Vdemo\Lib;

use \Vine\Component\Http\ResponseFactory;

/**
    * Varity api response format
 */
class ApiResponseFactory
{/*{{{*/
    const FMT_NAME      = 'fmt';
    const CALLBACK_NAME = '_callback';

    const FMT_VALUE_DUMP      = 'dump';
    const FMT_VALUE_JSON      = 'json';
    const FMT_VALUE_SERIALIZE = 'serialize';
    const FMT_VALUE_JSONP     = 'jsonp';

    /**
        * Get varity response use fmt
        *
        * @param array $data
        * @param \Vine\Component\Http\RequestInterface $request
        *
        * @return \Vine\Component\Http\ResponseInterface
     */
    public static function getResponse(array $data, \Vine\Component\Http\RequestInterface $request)
    {/*{{{*/
        $fmtValue = $request->getParam(self::FMT_NAME);

        $response = null;
        $factory  = new ResponseFactory();
        switch($fmtValue) {
            case self::FMT_VALUE_DUMP:
                ob_start();
                var_dump($data);
                $content  = ob_get_clean();
                $response = $factory->make($content);
                break;
            case self::FMT_VALUE_SERIALIZE:
                $content  = serialize($data);
                $response = $factory->make($content);
                break;
            case self::FMT_VALUE_JSONP:
                $callback = $request->getParam(self::CALLBACK_NAME);
                $response = $factory->jsonp($callback, $data);
                break;
            case self::FMT_VALUE_JSON:
            default:
                $response = $factory->json($data);
            }

        return $response;
    }/*}}}*/

    /**
        * Get varity success response
        *
        * @param array $data
        * @param string $msg
        * @param \Vine\Component\Http\RequestInterface $request
        *
        * @return \Vine\Component\Http\ResponseInterface
     */
    public static function getSuccessResponse(array $data, $msg, \Vine\Component\Http\RequestInterface $request)
    {/*{{{*/
        $result = array(
            'errno' => \Vdemo\Lib\Error\Errno::SUCCESS,
            'msg'   => $msg,
            'data'  => $data,
        );

        return self::getResponse($result, $request);
    }/*}}}*/

    /**
        * Get varity error response
        *
        * @param \Exception $e
        * @param \Vine\Component\Http\RequestInterface $request
        *
        * @return \Vine\Component\Http\ResponseInterface
     */
    public static function getErrorResponse(\Exception $e, \Vine\Component\Http\RequestInterface $request)
    {/*{{{*/
        $result = array(
            'errno' => $e->getCode(),
            'msg'   => $e->getMessage(),
        );

        return self::getResponse($result, $request);
    }/*}}}*/
}/*}}}*/
