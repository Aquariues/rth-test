<?php
/**
 * This file is part of the Cloudinary PHP package.
 *
 * (c) Cloudinary
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cloudinary\Transformation;

use Cloudinary\ArrayUtils;

/**
 * Trait CustomFunctionTrait
 *
 * @api
 */
trait CustomFunctionTrait
{
    /**
     * Specifies the wasm file to use for the custom function.
     *
     * For more information about WebAssembly functions see the documentation.
     *
     * @param string $source The public ID of the wasm file.
     *
     * @return CustomFunction
     *
     * @see \Cloudinary\Transformation\CustomFunction
     * @see https://cloudinary.com/documentation/custom_functions#webassembly_functions
     *
     */
    public static function wasm($source)
    {
        return static::create($source, CustomFunction::WASM);
    }

    /**
     * Specifies the URL of the remote custom function.
     *
     * For more information about remote custom functions see the documentation.
     *
     * @param string $source The URL of the remote function.
     *
     * @return CustomFunction
     *
     * @see \Cloudinary\Transformation\CustomFunction
     * @see https://cloudinary.com/documentation/custom_functions#remote_functions
     *
     */
    public static function remote($source)
    {
        return static::create($source, CustomFunction::REMOTE);
    }

    /**
     * Specifies the URL of the remote preprocessing custom function.
     *
     * For more information about preprocessing custom functions see the documentation.
     *
     * @param string $source The URL of the remote preprocessing function.
     *
     * @return CustomFunction
     *
     * @see \Cloudinary\Transformation\CustomFunction
     * @see https://cloudinary.com/documentation/custom_functions#preprocessing_custom_functions
     */
    public static function preprocessRemote($source)
    {
        return static::create($source, CustomFunction::REMOTE, true);
    }

    /**
     * Named constructor.
     *
     * @param array $values
     *
     * @return CustomFunction
     * @see \Cloudinary\Transformation\CustomFunction
     *
     * @internal
     */
    protected static function create(...$values)
    {
        return new CustomFunction(...$values);
    }

    /**
     * Creates a new instance from an array of parameters.
     *
     * @param array $params The parameters.
     * @param bool  $isPre  Indicates whether the function is a pre-processing function. Default: false.
     *
     * @return CustomFunction
     * @see \Cloudinary\Transformation\CustomFunction
     *
     */
    public static function fromParams($params, $isPre = false)
    {
        if (! is_array($params)) {
            return static::create($params);
        }

        $functionType = ArrayUtils::get($params, 'function_type');
        $source       = ArrayUtils::get($params, 'source');

        return static::create($source, $functionType, $isPre);
    }
}
