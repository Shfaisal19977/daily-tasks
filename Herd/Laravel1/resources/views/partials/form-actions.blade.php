<div class="flex flex-col-reverse sm:flex-row gap-3 sm:justify-end sm:gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
    <a
        href="{{ $cancelUrl ?? url()->previous() }}"
        class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors"
    >
        Cancel
    </a>
    <button
        type="submit"
        class="inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors"
    >
        {{ $submitText ?? 'Save' }}
    </button>
</div>

