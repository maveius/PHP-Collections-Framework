# PHP-Collections-Framework
PHP Collections Framework(PCF), manipulate collections of objects like C++, Java and C#

It consists of a groups of classes that implement data structures to manipulate collections of values like HashSet, ArrayList, LinkedList, Stack, Queue, HashMap and TreeMap. They can be found at /pcf/collection folder, the namespace is Resource\Collection. These data structures allow easy and powerful handling of PHP objects, as PHP arrays are not object oriented, and insufficient to manipulate object collections. For whoever familiar with the concept of Data Structure, this API should be very familiar to you, it also is written in a way to compensate for PHP's own language limitations. 

The package also provides wrapper classes to encapsulate basic data types so they can be treated as objects in the collections, since it does not support primitive types. These wrapper classes are included in the /pcf/native folder, the namespace is Resource\Native. To create your own collectible objects, you need to either extend class Object, or to implement interface Objective. The later can be very useful if you extend from PHP built-in classes and cannot inherit from Object.

The Exception and Utility package provides additional classes that can be used together with PCF. The Utility classes introduce comparable, comparator and hashing functionality. Thery are included in the /pcf/utility folder, the namespace is Resource\Utility.
