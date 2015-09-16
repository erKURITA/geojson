<?php
namespace unit_tests\geojson\objects;

use geojson\objects\Feature;
use geojson\objects\geometry\Point;

/**
 * Class FeatureTest
 * @package unit_tests\geojson\objects
 */
class FeatureTest extends \PHPUnit_Framework_TestCase
{
    /** @var Feature */
    private $sut;

    public function setUp()
    {
        $this->sut = new Feature();

        $point = new Point(8.7, 6.9);

        $this->sut->set($point);
    }

    public function testEmptyFeature()
    {
        $sut = new Feature();

        $expected_json = <<<END
{"type":"Feature","properties":{},"geometry":null}
END;

        $this->assertEquals($expected_json, json_encode($sut->toGeoJSON()));
    }

    public function testGeometryWithNoProperties()
    {
        $expected_json = <<<END
{"type":"Feature","properties":{},"geometry":{"type":"Point","coordinates":[8.7,6.9]}}
END;

        $this->assertEquals($expected_json, json_encode($this->sut->toGeoJSON()));
    }

    public function testGeometryWithProperties()
    {
        $this->sut->addProperty('test', 'value');

        $expected_json = <<<END
{"type":"Feature","properties":{"test":"value"},"geometry":{"type":"Point","coordinates":[8.7,6.9]}}
END;

        $this->assertEquals($expected_json, json_encode($this->sut->toGeoJSON()));
    }
}
