<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Geography\Address\Physical\ByCountry\Br;

use Talentify\ValueObject\Geography\Address\ByCountry\Br\CEP;
use Talentify\ValueObject\Geography\Address\ByCountry\Br\Municipality;
use Talentify\ValueObject\Geography\Address\ByCountry\Br\Neighbourhood;
use Talentify\ValueObject\Geography\Address\ByCountry\Br\State;
use Talentify\ValueObject\Geography\Address\ByCountry\Br\Street;
use Talentify\ValueObject\ValueObjectTestCase;

class BrPhysicalAddressTest extends ValueObjectTestCase
{
    public static function getClassName() : string
    {
        return BrPhysicalAddress::class;
    }

    /**
     * @return mixed[]
     */
    public function sameValueDataProvider() : array
    {
        return [
            [
                new BrPhysicalAddress(
                    new Street('Avenida', 'Sagitário', '138', 'Torre Foo'),
                    new Neighbourhood('Alpha Conde II'),
                    new Municipality('Barueri'),
                    new State('São Paulo', 'SP'),
                    new CEP('06473-073')
                ),
                new BrPhysicalAddress(
                    new Street('avenida', 'sagitário', '138', 'Torre Foo'),
                    new Neighbourhood('alpha Conde II'),
                    new Municipality('barueri'),
                    new State('são Paulo', 'SP'),
                    new CEP('06473-073')
                ),
            ],
        ];
    }

    /**
     * @return mixed[]
     */
    public function differentValueDataProvider() : array
    {
        return [
            [
                new BrPhysicalAddress(
                    new Street('avenida', 'sagitário', '138', 'Torre Foo'),
                    new Neighbourhood('alpha Conde II'),
                    new Municipality('barueri'),
                    new State('são Paulo', 'SP'),
                    new CEP('06473-073')
                ),
                new BrPhysicalAddress(
                    new Street('avenida', 'Foo', '138', 'Torre Foo'),
                    new Neighbourhood('alpha Conde 99'),
                    new Municipality('barueri'),
                    new State('são Paulo', 'SP'),
                    new CEP('06473-073')
                ),
            ],
            [
                new BrPhysicalAddress(
                    new Street('avenida', 'sagitário', '138', 'Torre Foo'),
                    new Neighbourhood('alpha Conde II'),
                    new Municipality('barueri'),
                    new State('são Paulo', 'SP'),
                    null
                ),
                new BrPhysicalAddress(
                    new Street('avenida', 'Foo', '138', 'Torre Foo'),
                    new Neighbourhood('alpha Conde 99'),
                    new Municipality('barueri'),
                    new State('são Paulo', 'SP'),
                    new CEP('06473-073')
                ),
            ],
            [
                new BrPhysicalAddress(
                    new Street('avenida', 'sagitário', '138', 'Torre Foo'),
                    new Neighbourhood('alpha Conde II'),
                    new Municipality('barueri'),
                    new State('são Paulo', 'SP'),
                    new CEP('06473-073')
                ),
                new BrPhysicalAddress(
                    new Street('avenida', 'Foo', '138', 'Torre Foo'),
                    new Neighbourhood('alpha Conde 99'),
                    new Municipality('barueri'),
                    new State('são Paulo', 'SP'),
                    null
                ),
            ],
            [
                new BrPhysicalAddress(
                    new Street('avenida', 'sagitário', '138', 'Torre Foo'),
                    new Neighbourhood('alpha Conde II'),
                    null,
                    new State('são Paulo', 'SP'),
                    new CEP('06473-073')
                ),
                new BrPhysicalAddress(
                    new Street('avenida', 'Foo', '138', 'Torre Foo'),
                    new Neighbourhood('alpha Conde 99'),
                    new Municipality('barueri'),
                    new State('são Paulo', 'SP'),
                    null
                ),
            ],
        ];
    }
}
