<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

namespace Ho\Review\Api\Data;

interface ConsiderationInterface
{
    /**
     * Constants defined for keys of data array.
     */
    const TYPE      = 'type';
    const REVIEW_ID = 'review_id';

    /**
     * Pros type code.
     */
    const CONSIDERATION_PROS = 1;

    /**
     * Cons type code.
     */
    const CONSIDERATION_CONS = 0;
}
