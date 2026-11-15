## 1.3.1 (2026-11-15)

- Re-release of 1.3.0 (the 1.3.0 tag was withdrawn)
- Check debug mode in CI

## 1.3.0 (2026-11-15)

- Fix: EvPrepare and EvFork factories used wrong classes, which led to memory access issues
- Fix: watchers read the loop after it was destroyed and reset to NULL
- Fix out-of-bounds memory reads due to out-of-range priority
- Fix: EvEmbed use-after-free: keep the embedded loop alive
- Fix the missing class argument in EvEmbed::set() parameter parsing.
- Generate compile_commands.json for IDE
- Fix leak in EvEmbed object destructor
- Fix segfault in EvCheck::createStopped()
- Fix build warnings
- Add signal number validation to Ev::feedSignal() and Ev::feedSignalEvent()
- Check the upper bound of the valid signal numbers (all methods/functions accepting signal numbers)
- Add builds with enabled address sanitizer
- Fix parallel test crash on ZTS PHP 8.6; mirror CI matrix in docker-compose
- Fix Bitbucket mirroring workflow (it failed pushing existing tags)

## 1.2.4 (2026-09-21)

- Fix PHP 8.6 build (by nicolas-grekas @ github.com)

## 1.2.3 (2026-01-27)

- Fix #54: non-debug compilation failed with PHP 8.5.2+

## 1.2.2 (2025-11-04)

- Fix #53: php_stream_cast() without the PHP_STREAM_CAST_INTERNAL caused warnings

## 1.2.1 (2025-07-17)

- Use zend_ce_exception instead of zend_exception_get_default() for 8.5 (patch by Remi Collet)

## 1.2.0 (2024-09-03)

- Support for PHP versions older than 8 has been dropped. Maintaining compatibility with multiple PHP versions (5, 7, and 8) has become increasingly difficult. Recent changes in PHP 8.3 have further complicated the build scripts. Additionally, as PHP releases older than 8.1 are now officially unsupported, it has become challenging to continue supporting PHP 5 and 7.
- Fix #51: building statically with PHP 8.3.10 fails with an "unknown" PHP version.

## 1.1.6RC1 (2021-11-13)

- Suppress warnings for UnwindExit and GracefulExit in PHP 8. Thanks to Aaron Piotrowski.

## 1.1.5 (2021-09-18)

- Fix #40: PHP 8 Windows build: the list of source files in config.w32 was incorrect for PHP 8.
- Fix #44: segmentation fault when the watcher is destroyed in its callback and an exception is thrown.

## 1.1.4 (2021-07-26)

- Fix tests with PHP 8.1.0beta (both NTS and ZTS) and 5 ZTS. Thanks to Remi Collet.

## 1.1.3 (2021-07-26)

- Fix #43: watcher was not stopped on an uncaught exception in the callback.

## 1.1.2 (2021-02-16)

- Fix Windows build configuration for PHP 8

## 1.1.1r1 (2021-02-15)

- Stable version release

## 1.1.1-beta (2021-02-04)

- Fix #39: tests/bug33.phpt is slow on s390x
- Fix tests/10_signal.phpt which failed on mips64 Alpinelinux due to a different value of SIGUSR1

## 1.1.0-beta (2021-02-01)

- Upgrade to PHP 8

## 1.0.9 (2020-11-19)

- Fix GC issues revealed with PHP 7.4.1
- Fix tests/10_signal.phpt which failed with debug build of PHP
- Make the sockets dependency optional in the Windows build configuration.

## 1.0.8 (2019-12-29)

- Fix build warnings with PHP 7.4.0-alpha1: 'incompatible pointer type' warnings occurred in assignments to the write property handlers (thanks to Remi Collet).
- Re-fix the Windows build errors related to errno in a way that the libev sources are left pristine. (The root of the issue is actually rooted in the PHP code where the errno macro is re-defined.)

## 1.0.7 (2019-12-07)

- Update libev
- Fix Windows build by applying a patch suggested by Christoph M. Becker.

## 1.0.6

- Fix #35: Segmentation Fault / Assertion Failure with PHP 7.3
- Fix build warnings

## 1.0.5 (2017-10-24)

- Fix #33 in PHP 7: the return value of EvPeriodic reschedule callback was ignored

## 1.0.4 (2016-12-02)

- Fix memory leak in PHP 7.0.13

## 1.0.3 (2016-07-29)

- Fix #29: object properties were wrapped in double quotes

## 1.0.2 (2016-07-29)

- Fix #28: generator test failed with PHP 5.4

## 1.0.1 (2016-07-29)

- Fix #27: callbacks with < 2 arguments were rejected

## 1.0.0 (2016-05-17)

- Fix #24

## 1.0.0RC9 (2016-02-22)

- Windows package fix

## 1.0.0RC7

- Fix PECL package

## 1.0.0RC6 (2016-02-22)

- Fix Windows build

## 1.0.0RC5 (2016-02-22)

- Add Windows support

## 1.0.0RC4 (2016-02-08)

- Fix memory leak in PHP 7 due to incorrect default loop destruction
- Remove pthreads dependency (pthread_atfork setup for the ev_loop_fork(EV_DEFAULT) call)

## 1.0.0RC3 (2015-12-16)

- Fix #18

## 1.0.0RC2 (2015-11-22)

- Fix EvChild::set() parameter parsing (thanks to Remi)
- Fix #16: get_properties handler failed with segmentation fault
- Fix #17: EvSignal::$signum property always returned NULL
- Fix EvStat::$path property always returned NULL

## 1.0.0RC1 (2015-11-20)

- Add PHP 7 support

## 0.2.17

- EvIo::__construct() and EvIo::set() now throw Exception in case of invalid stream or file descriptor.

## 0.2.16

- Fix #13: compilation issue in Mac OS X 10.11

## 0.2.15 (2015-05-03)

- Fix #12: marked as CLI-only extension (the changes are actually missing in 0.2.14)

## 0.2.13 (2014-12-08)

- Fix #11: `pecl install ev` command fails with non-standard PHP installation prefix.

## 0.2.12

- Fix #10: segfault in test suite for ZTS (thanks to Remi Collet)

## 0.2.11 (2014-09-07)

- Fix #7: static building was not supported (Tim)
- Fix #9: factory methods messed up the instance zval properties thus causing fatal errors in PHP 5.6
- Fix EvWatcher::keepalive method didn't regard the default value of the 1st argument.
- Pull latest fixes from libev's upstream

## 0.2.10 (2013-08-17)

- Fix segmentation fault after watcher restart (Frank Mayer)
- Fix missing get_gc property handler
- Fix operators applied to uninitialized EvWatcher::data property caused unexpected results

## 0.2.9 (2013-08-05)

- Fix memory leaks in objects derived from EvWatcher
- Optimize some frequent checks

## 0.2.8 (2013-07-21)

- Fix segmentation fault in EvLoop/EvWatcher dtors caused by reference variables stored in 'data' property
- Fix EvLoop/EvWatcher object dtors sometimes didn't free the 'data' member until the script shutdown phase
- Fix get_properties property handler was not implemented for PHP >= 5.4.0

## 0.2.7 (2013-07-20)

- Fix a typo in ev.c because of which dump stuff didn't work in PHP < 5.5.0
- Remove the "Returning previously created default loop" warning

## 0.2.6 (2013-07-19)

- Merge in 5lava/pecl-ev (pull request #1) @ Bitbucket
- Make PHP 5.5.0-compatible
- Upgrade libev to version 4.15

## 0.2.5

- Fix build error due to return (void) from function returning int on Mac OS X
- Fix bug #64788: var_dump() of EvIo watcher caused disfunction of whole event loop

## 0.2.4

- Fix build error in Mac OS X: inline php_ev_set_watcher_priority function had been exported as a library symbol

## 0.2.3 (2013-01-12)

- Fix build errors where sockets extension was required, made optional (thanks to auroraeos on #php.pecl@efnet IRC).
- Fix build errors for non-threaded configuration.
- Fix and improve streams' casting.

## 0.2.2 (2013-01-08)

- Fix bug #3: ev_loop_fork invoked with EV_DEFAULT_UC (thanks to John Chen)
- Set callbacks' no_separation = 1 (was 0)
- Fix typo in package.xml
- Fix markdown syntax

## 0.2.1 (2013-01-01)

- Fix get_property_ptr_ptr for zval properties was not supported.
- Check for attempts to bind a signal to different event loops

## 0.2.0 (2012-12-27)

- Move ev_* functions to Ev singleton (due to some issues with reflection)
- Rename EvLoop::break to EvLoop::stop, and ev_break to Ev::stop
- Move all constants to Ev class
- Fix release version
- Remove callback parameter from EvLoop constructor/factories
- Make watcher createStopped methods final
- Make watcher factory methods final

## 0.1.1 (2012-12-24)

- Fix PECL build error

## 0.1.0

- Initial release
