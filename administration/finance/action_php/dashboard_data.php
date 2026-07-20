<?php

    // Shared data access for the finance dashboard pages.
    // Every read is fail-soft: if the database is unreachable, a table is
    // missing, or a query returns no rows, the caller receives null and
    // falls back to sample data so the dashboard always renders.

    if (function_exists('mysqli_report')) {

        mysqli_report(MYSQLI_REPORT_OFF);
    }

    try {

        @include_once __DIR__ . '/database.php';

    } catch (Throwable $e) {

        $conn = null;
    }

    if (!isset($conn) || !($conn instanceof mysqli)) {

        $conn = null;
    }


    // count the rows of a single table, null when unreadable.....

    function dash_count($conn, $table) {

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


    // sum a numeric column of a table, null when unreadable.....

    function dash_sum($conn, $table, $column) {

        if (!$conn) {

            return null;
        }

        $result = @mysqli_query($conn, "SELECT SUM(" . $column . ") AS total FROM " . $table);

        if (!$result) {

            return null;
        }

        $row = mysqli_fetch_assoc($result);

        return ($row['total'] === null) ? 0 : (float) $row['total'];
    }


    // run a select and return all rows, null on failure or empty result.....

    function dash_rows($conn, $query) {

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

    function dash_text($value) {

        return htmlspecialchars((string) $value, ENT_QUOTES);
    }


    // shorten long free text for table cells.....

    function dash_truncate($value, $length = 70) {

        $value = trim((string) $value);

        if (strlen($value) <= $length) {

            return $value;
        }

        return substr($value, 0, $length) . '…';
    }


    // render a status value as a labelled chip (never colour alone).....

    function dash_status_chip($status) {

        $status = strtolower(trim((string) $status));

        if ($status === 'registered' || $status === 'published' || $status === 'open' || $status === 'active' || $status === 'paid' || $status === 'approved') {

            return '<span class="chip good">' . dash_text($status) . '</span>';
        }

        if ($status === '') {

            return '<span class="chip neutral">unknown</span>';
        }

        return '<span class="chip warn">' . dash_text($status) . '</span>';
    }


    // format a count for a stat tile, with a sample-data fallback.....

    function dash_stat($count, $fallback) {

        if ($count === null) {

            return array('value' => number_format($fallback), 'sample' => true);
        }

        return array('value' => number_format($count), 'sample' => false);
    }


    // format a naira amount for a stat tile, with a sample-data fallback.....

    function dash_money_stat($amount, $fallback) {

        if ($amount === null) {

            return array('value' => '₦' . number_format($fallback), 'sample' => true);
        }

        return array('value' => '₦' . number_format($amount), 'sample' => false);
    }


    // format a naira amount for a table cell.....

    function dash_money($amount) {

        return '₦' . number_format((float) $amount);
    }

?>
