<?php

/**
 * class NielsHoppe\PHPCSS\MediaQueries\MediaQueryList
 */

namespace NielsHoppe\PHPCSS\MediaQueries;

/**
 * MediaQueryList
 * @see https://www.w3.org/TR/css3-mediaqueries/#syntax
 */

class MediaQueryList {

    /**
     * @var MediaQuery[] $queries  A list of queries
     */

    private $queries;

    /**
     * Construct a MediaQueryList from an array of MediaQueries
     *
     * @param MediaQuery[] $queries
     */

    public function __construct ($queries = array()) {

        $this->queries = $queries;
    }

    /**
     * Adds a MediaQuery to this MediaQueryList
     *
     * @param MediaQuery $query
     */

    public function addMediaQuery (MediaQuery $query) {

        array_push($this->queries, $query);
    }

    /**
     * @TODO Copied from DeclarationList!
     * Shorthand for creating and adding a query to this MediaQueryList
     *
     * @param string $property
     * @param string $value
     * @param bool $important
     */

    public function createMediaQuery ($property, $value, $important = false) {

        $this->addMediaQuery(new MediaQuery($property, $value, $important));
    }

    /**
     * @TODO Copied from DeclarationList!
     * Get the queries in this list
     *
     * @param string[] $filter
     * @return MediaQuery[]
     */

    public function getMediaQueries ($filter = array()) {

        if (count($filter)) {

            $result = array();

            foreach ($this->queries as $query) {

                if (in_array($query->getProperty(), $filter)) {

                    array_push($result, $query);
                }
            }

            return $result;
        }

        return $this->queries;
    }

    /**
     * Return string representation
     *
     * @return string
     */

    public function __toString () {

        return implode("\n", array_map('strval', $this->queries));
    }
}
