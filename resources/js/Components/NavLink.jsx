import { Link } from '@inertiajs/react';

export default function NavLink({
  active = false, className = '', children, ...props
}) {
  return (
    <Link
      {...props}
      className={
        `inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none ${
          active
            ? 'border-indigo-400 dark:text-lime-200 text-gray-900 focus:border-indigo-700 '
            : 'border-transparent dark:text-teal-200 text-gray-500 dark:hover:text-blue-300 hover:text-gray-700 hover:border-gray-300 dark:focus:text-purple-200 focus:text-gray-700 focus:border-gray-300 '
        }${className}`
      }
    >
      {children}
    </Link>
  );
}
