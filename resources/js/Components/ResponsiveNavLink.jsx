import { Link } from '@inertiajs/react';

export default function ResponsiveNavLink({
  active = false, className = '', children, ...props
}) {
  return (
    <Link
      {...props}
      className={`w-full flex items-start ps-3 pe-4 py-2 border-l-4 ${
        active
          ? 'border-indigo-400 dark:text-indigo-200 text-indigo-700 dark:bg-purple-900 bg-indigo-50 focus:text-indigo-800 dark:focus:text-teal-200 dark:focus:bg-indigo-900 dark:focus:border-indigo-300 focus:bg-indigo-100 focus:border-indigo-700'
          : 'border-transparent dark:text-blue-200 dark:hover:text-gray-200 dark:bg-teal-800 dark:hover:bg-gray-800 text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 dark:focus:text-gray-200 dark:focus:bg-gray-800 focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300'
      } text-base font-medium focus:outline-none transition duration-150 ease-in-out ${className}`}
    >
      {children}
    </Link>
  );
}
