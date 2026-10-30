#include "embed.h"

/*  Patch by Christoph M. Becker */
#if defined(_WIN32) && defined(PHP_EV_USE_SOCKETS)
# undef errno
# define errno (*_errno())
#endif

/* libev's assertions abort the process, for example when the poll or kqueue backend finds that a watched
 * descriptor was closed. Like libev's release builds, compile them out unless debugging: the watchers of such a
 * descriptor are stopped instead, their callbacks receiving Ev::ERROR. */
#if !defined(PHP_EV_DEBUG) && !defined(NDEBUG)
# define NDEBUG
#endif
#include "./libev/ev.c"
