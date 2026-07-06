<?php

    // Shared data access for the director dashboard pages.
    // Every read is fail-soft: if the database is unreachable, a table is
    // missing, or a query returns no rows, the caller receives null and
    // falls back to sample data so the dashboard always renders.

    if (function_exists('mysqli_report')) {

        mysqli_report(MYSQLI_REPORT_OFF);
    }

    try {

        @include_once __DIR__ . '/../../../action_php/database.php';

    } catch (Throwable $e) {

        $conn = null;
    }

    if (!isset($conn) || !($conn instanceof mysqli)) {

        $conn = null;
    }


    // count the rows of a single table, null when unreadable.....

    function director_count($conn, $table) {

        if (!$conn) {

            return null;
        }

        $result = @mysqli_query($conn, "SELECT COUNT(*) AS total FROM " . $table);

        if (!$result) {

            return null;
        }

        $row = mysqli_fetch_assoc($result);

        return (int) $row['total'];
    }


    // sum counts across several tables, null when none are readable.....

    function director_count_sum($conn, $tables) {

        $total = null;

        foreach ($tables as $table) {

            $count = director_count($conn, $table);

            if ($count !== null) {

                $total = ($total === null) ? $count : $total + $count;
            }
        }

        return $total;
    }


    // run a select and return all rows, null on failure or empty result.....

    function director_rows($conn, $query) {

        if (!$conn) {

            return null;
        }

        $result = @mysqli_query($conn, $query);

        if (!$result || mysqli_num_rows($result) < 1) {

            return null;
        }

        $rows = array();

        while ($row = mysqli_fetch_assoc($result)) {

            $rows[] = $row;
        }

        return $rows;
    }


    // escape a value for html output.....

    function director_text($value) {

        return htmlspecialchars((string) $value, ENT_QUOTES);
    }


    // shorten long free text for table cells.....

    function director_truncate($value, $length = 70) {

        $value = trim((string) $value);

        if (strlen($value) <= $length) {

            return $value;
        }

        return substr($value, 0, $length) . '…';
    }


    // render a status value as a labelled chip (never colour alone).....

    function director_status_chip($status) {

        $status = strtolower(trim((string) $status));

        if ($status === 'registered' || $status === 'published' || $status === 'open' || $status === 'active') {

            return '<span class="chip good">' . director_text($status) . '</span>';
        }

        if ($status === '') {

            return '<span class="chip neutral">unknown</span>';
        }

        return '<span class="chip warn">' . director_text($status) . '</span>';
    }


    // format a count for a stat tile, with a sample-data fallback.....

    function director_stat($count, $fallback) {

        if ($count === null) {

            return array('value' => number_format($fallback), 'sample' => true);
        }

        return array('value' => number_format($count), 'sample' => false);
    }

?>
