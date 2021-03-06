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

/**
 * Defines the gravity based on directional values from a compass.
 *
 * **Learn more**:
 * <a href="https://cloudinary.com/documentation/image_transformations#control_gravity" target="_blank">
 * Control gravity for images</a> |
 * <a href="https://cloudinary.com/documentation/image_transformations#control_gravity" target="_blank">
 * Control gravity for videos</a>
 *
 * @api
 */
class CompassGravity extends GravityParam
{
    use CompassGravityBuilderTrait;

    const NORTH_WEST = 'north_west';
    const NORTH      = 'north';
    const NORTH_EAST = 'north_east';
    const WEST       = 'west';
    const CENTER     = 'center';
    const EAST       = 'east';
    const SOUTH_WEST = 'south_west';
    const SOUTH      = 'south';
    const SOUTH_EAST = 'south_east';
    const XY_CENTER  = 'xy_center';

    /**
     * CompassGravity constructor.
     *
     * @param string $direction
     */
    public function __construct($direction = null)
    {
        parent::__construct();

        $this->direction($direction);
    }

    /**
     * Sets the compass gravity direction.
     *
     * @param string $direction The gravity direction. Use the constants defined in this class.
     *
     * @return CompassGravity
     */
    protected function direction($direction)
    {
        $this->setParamValue($direction);

        return $this;
    }
}
