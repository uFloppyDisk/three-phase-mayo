/*
 * Simple Tic Tac Toe game to demonstrate 2D-arrays
 * This version of the program stores the game board characters in the board array.
 * Tabs are set to 8-spaces.
 */


// extended ASCII - for Windows computers
const	char	VERT = (char)179;
const	char	HORIZ = (char)196;
const	char	CROSS = (char)197;

// basic ASCII - for all computers
//const	char	VERT = '|';
//const	char	HORIZ = '-';
//const	char	CROSS = '+';


#include <iostream>
//#include <stdlib.h>		// Linux / MacOS
using namespace std;


void display(char board[][5]);
void init_board(char board[][5]);
void get_move(char player, char board[][5]);
void test_win(char board[][5]);
char test_board(char board[][5]);



int main()
{
	char	board[5][5];
	int	moves = 9;				// total number of moves
	char	player = 'X';				// current player

	init_board(board);				// initialize the game board

	while (moves > 0)				// while moves remain
	{
		display(board);
		get_move(player, board);
		test_win(board);
		moves--;				// one move taken
		player = (player == 'X') ? 'O' : 'X';	// change player's turn
	}

	display(board);					// no winner
	cout << "Draw!" << endl;

	return 0;
}


/* Initializes the game board. */

void init_board(char board[][5])
{
	for (int row = 0; row < 5; row += 2)		// initialize spaces
		for (int col = 0; col < 5; col += 2)
			board[row][col] = ' ';

	for (int row = 0; row < 5; row += 2)		// add vertical bars
		for (int col = 1; col < 5; col += 2)
			board[row][col] = VERT;

	for (int row = 1; row < 5; row += 2)		// add horizontal lines
		for (int col = 0; col < 5; col += 2)
			board[row][col] = HORIZ;

	for (int row = 1; row < 5; row += 2)		// add crossing lines
		for (int col = 1; col < 5; col += 2)
			board[row][col] = CROSS;
}


/* Displays the game board. */

void display(char board[][5])
{
	system("cls");		// Windows
	//system("clear");	// Linux

	cout << "  ";					// offset for col numbers
	for (int i = 0; i < 5; i++)			// print col numbers
		cout << i;
	cout << endl;

	for (int row = 0; row < 5; row++)
	{
		cout << row << " " ;			// print row numbers
		for (int col = 0; col < 5; col++)
			cout << board[row][col];
		cout << endl;
	}

	cout << endl;
}


/* Get the next player's move. */

void get_move(char player, char board[][5])
{
	int	row;
	int	col;

	cout << "Move for player: " << player << endl;
	do
	{
		cout << "Row: ";
		cin >> row;
		if (row == -1)
			exit(0);				// end early

		cout << "Col: ";
		cin >> col;
		if (col == -1)
			exit(0);				// end early

		if (row == -1 && col == -1)
			exit(0);

	} while (board[row][col] != ' ' ||			// board space not empty
		row < 0 || row > 4 || col < 0 || col > 4 ||);	// row or col out of bounds

	board[row][col] = player;
}


/* Checks to see if either player has won yet. */

void test_win(char board[][5])
{
	char result = test_board(board);

	if (result == 'X' || result == 'O')
	{
		display(board);
		cout << result << " wins!" << endl;
		exit(0);
	}
}


/*
 * Tests the board to see if either player has three marks in a row, column, or diagonal.
 * Returns the symbol of the winning player or space if there is no winner.
 */

char test_board(char board[][5])
{
	for (int row = 0; row < 5; row += 2)		// checks rows
	{
		if (board[row][0] == ' ')
			continue;
		if (board[row][0] == board[row][2] && board[row][2] == board[row][4])
			return board[row][0];		// winner found
	}

	for (int col = 0; col < 5; col += 2)		// checks columns
	{
		if (board[0][col] == ' ')
			continue;
		if (board[0][col] == board[2][col] && board[2][col] == board[4][col])
			return board[0][col];		// winner found
	}


	// check the prime diagonal
	if (board[0][0] == board[2][2] && board[4][4] == board[2][2])
		return board[0][0];			// winner found

	// check the non-prime diagonal
	if (board[0][4] == board[2][2] && board[2][2] == board[4][0])
		return board[0][4];			// winner found


	return ' ';					// no winner yet
}

