<?php

declare(strict_types=1);

/* This file is auto-generated. Don't edit directly! */

namespace Jsor\Doctrine\PostGIS\Functions;

use Jsor\Doctrine\PostGIS\AbstractFunctionalTestCase;
use Jsor\Doctrine\PostGIS\Entity\PointsEntity;

use function is_resource;
use function is_string;

/**
 * @group orm
 * @group functions
 */
final class ST_PointFromGeoHashTest extends AbstractFunctionalTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->_setUpEntitySchema([
            PointsEntity::class,
        ]);

        $em = $this->_getEntityManager();

        $entity = new PointsEntity([
            'text' => 'foo',
            'geometry' => 'POINT(1 1)',
            'point' => 'POINT(1 1)',
            'point2d' => 'SRID=3785;POINT(1 1)',
            'point3dz' => 'SRID=3785;POINT(1 1 1)',
            'point3dm' => 'SRID=3785;POINTM(1 1 1)',
            'point4d' => 'SRID=3785;POINT(1 1 1 1)',
            'point2dNullable' => null,
            'point2dNoSrid' => 'POINT(1 1)',
            'geography' => 'SRID=4326;POINT(1 1)',
            'pointGeography2d' => 'SRID=4326;POINT(1 1)',
            'pointGeography2dSrid' => 'POINT(1 1)',
        ]);

        $em->persist($entity);
        $em->flush();
        $em->clear();
    }

    /**
     * @group postgis-3.0
     */
    public function testQuery1(): void
    {
        $query = $this->_getEntityManager()->createQuery('SELECT ST_AsText(ST_PointFromGeoHash(\'9qqj7nmxncgyy4d0dbxqz0\')) AS value FROM Jsor\\Doctrine\\PostGIS\\Entity\\PointsEntity point');

        $result = $query->getSingleResult();

        array_walk_recursive($result, static function (&$data): void {
            if (is_resource($data)) {
                $data = stream_get_contents($data);

                if (false !== ($pos = strpos($data, 'x'))) {
                    $data = substr($data, $pos + 1);
                }
            }

            if (is_string($data)) {
                $data = trim($data);
            }
        });

        $expected = [
            'value' => 'POINT(-115.172816 36.114646)',
        ];

        $this->assertEqualsWithDelta($expected, $result, 0.001);
    }

    /**
     * @group postgis-3.1
     */
    public function testQuery2(): void
    {
        $query = $this->_getEntityManager()->createQuery('SELECT ST_AsText(ST_PointFromGeoHash(\'9qqj7nmxncgyy4d0dbxqz0\')) AS value FROM Jsor\\Doctrine\\PostGIS\\Entity\\PointsEntity point');

        $result = $query->getSingleResult();

        array_walk_recursive($result, static function (&$data): void {
            if (is_resource($data)) {
                $data = stream_get_contents($data);

                if (false !== ($pos = strpos($data, 'x'))) {
                    $data = substr($data, $pos + 1);
                }
            }

            if (is_string($data)) {
                $data = trim($data);
            }
        });

        $expected = [
            'value' => 'POINT(-115.17281600000001 36.11464599999999)',
        ];

        $this->assertEqualsWithDelta($expected, $result, 0.001);
    }

    public function testQuery3(): void
    {
        $query = $this->_getEntityManager()->createQuery('SELECT ST_AsText(ST_PointFromGeoHash(\'9qqj7nmxncgyy4d0dbxqz0\', 4)) AS value FROM Jsor\\Doctrine\\PostGIS\\Entity\\PointsEntity point');

        $result = $query->getSingleResult();

        array_walk_recursive($result, static function (&$data): void {
            if (is_resource($data)) {
                $data = stream_get_contents($data);

                if (false !== ($pos = strpos($data, 'x'))) {
                    $data = substr($data, $pos + 1);
                }
            }

            if (is_string($data)) {
                $data = trim($data);
            }
        });

        $expected = [
            'value' => 'POINT(-115.13671875 36.123046875)',
        ];

        $this->assertEqualsWithDelta($expected, $result, 0.001);
    }
}
