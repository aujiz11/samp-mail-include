# samp-mail-include

[![sampctl](https://img.shields.io/badge/sampctl-samp--mail--include-2f2f2f.svg?style=for-the-badge)](https://github.com/aujiz11/samp-mail-include)

<!--
Short description of your library, why it's useful, some examples, pictures or
videos. Link to your forum release thread too.

Remember: You can use "forumfmt" to convert this readme to forum BBCode!

What the sections below should be used for:

`## Installation`: Leave this section un-edited unless you have some specific
additional installation procedure.

`## Testing`: Whether your library is tested with a simple `main()` and `print`,
unit-tested, or demonstrated via prompting the player to connect, you should
include some basic information for users to try out your code in some way.

And finally, maintaining your version number`:

* Follow [Semantic Versioning](https://semver.org/)
* When you release a new version, update `VERSION` and `git tag` it
* Versioning is important for sampctl to use the version control features

Happy Pawning!
-->

## Installation

Simply install to your project:

```bash
sampctl package install aujiz11/samp-mail-include
```

Include in your code and begin using the library:

```pawn
#include <mail>
```


**Important:**

You need to put `mail.php` in the host then define the URL leading to it in the game script!

## Usage

The main function for sending emails is `Mail_Send`. Here's the function syntax and parameters:

```pawn
Mail_Send(playerid, const function[], const to[], const additional_headers[], const subject[], const message[], type = MAIL_TYPE_NORMAL)
```

**Parameters**
- `playerid`: The ID of the player sending the email
- `function[]`: Callback function name that will be called when the email is sent
- `to[]`: Recipient's email address
- `additional_headers[]`: Additional email headers (optional)
- `subject[]`: Email subject line
- `message[]`: Email body content
- `type`: Email type (default: MAIL_TYPE_NORMAL)
    - `MAIL_TYPE_NORMAL`: Plain text email
    - `MAIL_TYPE_HTML`: HTML formatted email

**Example Usage**
```pawn
public OnPlayerConnect(playerid)
{
	Mail_Send(playerid, Mail:MAIL_FUNC, "to_username@gmail.com", "MAIL Name", "Send Mail Test", "Test");
}

Mail_Response:MAIL_FUNC(playerid, response_code, const data[]) {
	switch (response_code) {
        case 200: {
            // success
        }
        default: {
            // error
        }
    }

	printf(data);
}
```

## Testing

<!--
Depending on whether your package is tested via in-game "demo tests" or
y_testing unit-tests, you should indicate to readers what to expect below here.
-->

To test, simply run the package:

```bash
sampctl package run
```
