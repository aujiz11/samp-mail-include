/*

	About: Mail Include v1.0
	Author: Aujiz
	Developed from <m_main.inc> by Noname at Pawno-Info.RU forum

*/

#if defined _mail_included
	#endinput
#endif
#define _mail_included

#tryinclude <open.mp>

#if !defined _INC_a_http
	#error You must include "a_http.inc" before including this
#endif

#if !defined MAIL_URL
	#error Please define the URL that contains the Mail PHP script.
#endif

#if !defined MAIL_ADDRESS
	#error Please define E-Mail address to send messages.
#endif

#if !defined isnull
    #define isnull(%1) ((!(%1[0])) || (((%1[0]) == '\1') && (!(%1[1]))))
#endif

#if !defined MAX_MAIL_SIZE
	#define MAX_MAIL_SIZE 1028
#endif

#define MAIL_TYPE_NORMAL 	0
#define MAIL_TYPE_HTML 		1

#define MAX_FUNCTION_NAME 	32

#define Mail_Response:%0(%1) \
	forward MR_%0(%1); \
	public MR_%0(%1)

#define Mail: #

forward OnPlayerMailScriptResponse(playerid, response_code, const data[]);

static
	m_player_function[MAX_PLAYERS][MAX_FUNCTION_NAME + 1 char];

stock Mail_Send(playerid, const function[], const to[], const additional_headers[], const subject[], const message[], type = MAIL_TYPE_NORMAL)
{
	new
		info[MAX_MAIL_SIZE + 1];

	m_player_function[playerid] = !"MR_";
	strcat(m_player_function[playerid], function);
	format(info, sizeof(info), "to=%s&additional_headers=%s&subject=%s&message=%s&additional_parameters="MAIL_ADDRESS"&type=%i", to, additional_headers, subject, message, type);
	HTTP(playerid, HTTP_POST, MAIL_URL, info, !"OnPlayerMailScriptResponse");
	return 1;
}

public OnPlayerMailScriptResponse(playerid, response_code, const data[])
{
	if (funcidx(m_player_function[playerid]) != -1)
		CallLocalFunction(m_player_function[playerid], !"iis", playerid, response_code, (isnull(data)) ? (!"\1") : (data));
	return 1;
}
