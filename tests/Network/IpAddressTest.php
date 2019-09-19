<?php

declare(strict_types=1);

namespace Talentify\ValueObject\Network;

use Talentify\ValueObject\ValueObjectTestCase;

class IpAddressTest extends ValueObjectTestCase
{
    /**
     * @test
     */
    public function willThrownExceptionIfValueIsInvalid() : void
    {
        $this->expectException(\InvalidArgumentException::class);
        new IpAddress('fooBar');
    }

    public static function getClassName() : string
    {
        return IpAddress::class;
    }

    public function sameValueDataProvider() : array
    {
        return [
            [new IpAddress('127.0.0.1'), new IpAddress('127.0.0.1')],
            [
                new IpAddress('2001:0db8:85a3:08d3:1319:8a2e:0370:7344'),
                new IpAddress('2001:0db8:85a3:08d3:1319:8a2e:0370:7344')
            ],
            // #FIXME these as equal IPv6 addresses
//            [
//                new IpAddress('2001:0db8:85a3:0000:0000:0000:0000:7344'),
//                new IpAddress('2001:0db8:85a3::7344')
//            ]
        ];
    }

    public function differentValueDataProvider() : array
    {
        return [
            [new IpAddress('127.0.0.1'), new IpAddress('192.168.0.1')],
            [
                new IpAddress('2001:0db8:85a3:08d3:1319:8a2e:0370:7344'),
                new IpAddress('2001:0db8:85a3:08d3:1319:8a2e:0370:5555')
            ]
        ];
    }
}
