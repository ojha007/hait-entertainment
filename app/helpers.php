<?php
if (!function_exists('successMessage')) {
    /**
     * @param string $index
     * @param ...$messages
     * @return array|false|string|string[]
     */
    function successMessage(string $index, ...$messages)
    {
        $success = [
            'CREATED' => '%s created successfully.',
            'UPDATED' => '%s updated successfully.',
            'DELETED' => '%s deleted successfully.',
        ];
        $message = $success[$index] ?? false;
        if (!$message) return 'success';
        return str_replace('%s', $messages[0], $message);
    }
}

if (!function_exists('errorMessage')) {
    /**
     * @param string $index
     * @param ...$messages
     * @return array|false|string|string[]
     */
    function errorMessage(string $index, ...$messages)
    {
        $success = [
            'CREATE' => 'Failed to create %s .Try again',
            'UPDATE' => 'Failed to updates %s .Try again',
            'DELETE' => 'Failed to delete %s .Try again',
        ];
        $message = $success[$index] ?? false;
        if (!$message) return 'error';
        return str_replace('%s', $messages[0], $message);
    }
}

if (!function_exists('spanByStatus')) {

    function spanByStatus($status, $withPull = ''): string
    {

        switch (strtolower($status)) {
            case 'yes':
            case '1':
                $labelClass = 'bg-green';
                $labelName = 'Active';
                break;
            case 'no';
            case '0':
                $labelClass = 'bg-yellow';
                $labelName = 'Inactive';
                break;
            case 'pending':
                $labelClass = 'bg-yellow';
                $labelName = $status;
                break;
            case 'verified':
            case 'approved':
            case 'accepted':
                $labelClass = 'bg-green';
                $labelName = $status;
                break;
            case 'rejected':
                $labelClass = 'bg-red';
                $labelName = $status;
                break;
            default:
                $labelClass = 'bg-blue';
                $labelName = $status;
        }
        return '<span style="cursor: default;"
        class="label btn btn-flat  ' . $labelClass . ' ' . ($withPull) . '">'
            . ucfirst($labelName) . '</span>';
    }
}
