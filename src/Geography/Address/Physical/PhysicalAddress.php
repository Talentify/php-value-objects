<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Address\Physical;

use Talentify\ValueObject\Geography\Address\Address;
use Talentify\ValueObject\Geography\Address\City;
use Talentify\ValueObject\Geography\Address\Country;
use Talentify\ValueObject\Geography\Address\PostalCode;
use Talentify\ValueObject\Geography\Address\Region;
use Talentify\ValueObject\Geography\Address\Street;

/**
 * An address with only the location i.e. the address without name and company name.
 *
 * @see https://en.wikipedia.org/wiki/Address#Address_format
 */
interface PhysicalAddress extends Address
{
    /**
     * Street.
     */
    public function getStreet() : ?Street;

    /**
     * City.
     */
    public function getCity() : ?City;

    /**
     * Can be state, county, district, province, region, etc.
     *
     * @see \Talentify\ValueObject\Geography\Address\BaseRegion for details.
     */
    public function getRegion() : ?Region;

    /**
     * Postal code.
     *
     * @see \Talentify\ValueObject\Geography\Address\BasePostalCode for details.
     */
    public function getPostalCode() : ?PostalCode;

    /**
     * Country.
     */
    public function getCountry() : ?Country;

    /**
     * The complete address that may be formatted.
     */
    public function getAddress() : string;

    /**
     * The complete address that may be formatted.
     *
     * @see PhysicalAddress::getAddress()
     */
    public function __toString() : string;
}
