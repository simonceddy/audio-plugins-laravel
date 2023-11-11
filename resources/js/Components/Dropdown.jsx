/* eslint-disable import/no-extraneous-dependencies */
import {
  useState, createContext, useContext, Fragment, useMemo
} from 'react';
import { Link } from '@inertiajs/react';
import { Transition } from '@headlessui/react';

const DropDownContext = createContext();

function Dropdown({ children }) {
  const [open, setOpen] = useState(false);

  const toggleOpen = () => {
    setOpen((previousState) => !previousState);
  };

  const contextValue = useMemo(() => ({
    open, setOpen, toggleOpen
  }), [open]);
  return (
    <DropDownContext.Provider value={contextValue}>
      <div className="relative">{children}</div>
    </DropDownContext.Provider>
  );
}

function Trigger({ children }) {
  const { open, setOpen, toggleOpen } = useContext(DropDownContext);

  return (
    <>
      <div role="presentation" onClick={toggleOpen}>{children}</div>

      {open && <div role="presentation" className="fixed inset-0 z-40" onClick={() => setOpen(false)} />}
    </>
  );
}

function Content({
  align = 'right', width = '48', contentClasses = 'py-1 bg-white dark:bg-black dark:text-white', children
}) {
  const { open, setOpen } = useContext(DropDownContext);

  let alignmentClasses = 'origin-top';

  if (align === 'left') {
    alignmentClasses = 'ltr:origin-top-left rtl:origin-top-right start-0';
  } else if (align === 'right') {
    alignmentClasses = 'ltr:origin-top-right rtl:origin-top-left end-0';
  }

  let widthClasses = '';

  if (width === '48') {
    widthClasses = 'w-48';
  }

  return (
    <Transition
      as={Fragment}
      show={open}
      enter="transition ease-out duration-200"
      enterFrom="opacity-0 scale-95"
      enterTo="opacity-100 scale-100"
      leave="transition ease-in duration-75"
      leaveFrom="opacity-100 scale-100"
      leaveTo="opacity-0 scale-95"
    >
      <div
        role="presentation"
        className={`absolute z-50 mt-2 rounded-md shadow-lg ${alignmentClasses} ${widthClasses}`}
        onClick={() => setOpen(false)}
      >
        <div className={`rounded-md ring-1 ring-black ring-opacity-5 ${contentClasses}`}>{children}</div>
      </div>
    </Transition>
  );
}

function DropdownLink({ className = '', children, ...props }) {
  return (
    <Link
      {...props}
      className={
        `block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-teal-200 dark:hover:bg-blue-800 dark:focus:bg-blue-800 transition duration-150 ease-in-out ${
          className}`
      }
    >
      {children}
    </Link>
  );
}

Dropdown.Trigger = Trigger;
Dropdown.Content = Content;
Dropdown.Link = DropdownLink;

export default Dropdown;
