<?php

    // Shared data access for the principal dashboard pages.
    // Every read is fail-soft: if the database is unreachable, a table is
    // missing, or a query returns no rows, the caller receives null and
    // falls back to sample data so the pages always render.

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

    function principal_count($conn, $table) {

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


    // run a select and return all rows, null on failure or empty result.....

    function principal_rows($conn, $query) {

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


    // sum one numeric column over a filtered table, null when unreadable.....

    function principal_sum($conn, $table, $column, $where = '') {

        if (!$conn) {

            return null;
        }

        $query = "SELECT COALESCE(SUM(" . $column . "), 0) AS total FROM " . $table;

        if ($where !== '') {

            $query .= " WHERE " . $where;
        }

        $result = @mysqli_query($conn, $query);

        if (!$result) {

            return null;
        }

        $row = mysqli_fetch_assoc($result);

        return (float) $row['total'];
    }


    // escape a value for html output.....

    function principal_text($value) {

        return htmlspecialchars((string) $value, ENT_QUOTES);
    }


    // shorten long free text for table cells.....

    function principal_truncate($value, $length = 70) {

        $value = trim((string) $value);

        if (strlen($value) <= $length) {

            return $value;
        }

        return substr($value, 0, $length) . '…';
    }


    // render a status value as a labelled chip (never colour alone).....

    function principal_status_chip($status) {

        $status = strtolower(trim((string) $status));

        if ($status === 'registered' || $status === 'approved' || $status === 'published' || $status === 'open' || $status === 'active') {

            return '<span class="chip good">' . principal_text($status) . '</span>';
        }

        if ($status === '') {

            return '<span class="chip neutral">unknown</span>';
        }

        return '<span class="chip warn">' . principal_text($status) . '</span>';
    }


    // format a count for a stat tile, with a sample-data fallback.....

    function principal_stat($count, $fallback) {

        if ($count === null) {

            return array('value' => number_format($fallback), 'sample' => true);
        }

        return array('value' => number_format($count), 'sample' => false);
    }


    // format an amount of naira for display.....

    function principal_naira($amount) {

        return '₦' . number_format((float) $amount, 2);
    }

?>
