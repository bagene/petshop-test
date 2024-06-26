<?php

declare(strict_types=1);

namespace Bagene\Bacs;

final class BacsStub
{
    /**
     * @return array{
     *     vol: string,
     *     hdr1: string,
     *     hdr2: string,
     *     uhl: string,
     *     standard: string[],
     *     eof1: string,
     *     eof2: string,
     *     utl: string,
     * }
     */
    public static function stub(): array
    {
        return [
            "vol" => "VOL1Mk2OPn0                              BACSNO                                1",
            "hdr1" => "HDR1ABACSNOS   BACSNOMk2OPn00010001100010 22087 2308900000003LUNL7m9p1lfZ       ",
            "hdr2" => "HDR2F0200000106                                   00                            ",
            "uhl" => "UHL1 22087999999    000000004 MULTI  721       AUD5020                          ",
            "standard" => [
                "1234561234567800N12345612345678/RO100000010000Test              123&abc           TestTestTestTestTe 22087"
            ],
            "eof1" => "EOF1ABACSNOS   BACSNOMk2OPn00010001100010 22087 230890UEg9lb3LUNL7m9p1lfZ       ",
            "eof2" => "EOF2F0200000106                                   00                            ",
            "utl" => "UTL10000000000000000000000000000000000000000        0000001                     "
        ];
    }
}
