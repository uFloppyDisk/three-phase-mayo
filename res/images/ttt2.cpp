/*
 * Simple Tic Tac Toe game to demonstrate 2D-arrays.
 * This version of the program does NOT store the game board characters in the array.
 * Tabs are set to 8-spaces.
 */


// extended ASCII - for Windows computers
const	char	VERT = (char)179;
const	char	HORIZ = (char)196;
const	char	CROSS = (char)197;

// basic ASCII - for all computers
//const	char	VERT = '|';
//const	char	HORIZ = '-';
//const	char	CROSS = '-';


/ Horizontal line separating the three rows. Constructed from the constants above.
const	char	HLINE[] = { ' ', ' ', HORIZ, CROSS, HORIZ, CROSS,  HORIZ, '\0' };


#include <iostream>
//#include <stdlib.h>		// Linux / MacOS
using namespace std;


void display(char board[][3]);
void init_board(char board[][3]);
void get_move(char player, char board[][3]);
void test_win(char board[][3]);
char test_board(char board[][3]);



int main()
{
	char	board[3][3];
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

	display(board);
	cout << "Draw!" << endl;

	return 0;
}


/* Initializes the game board. */

void init_board(char board[][3])
{
	for (int row = 0; row < 3; row++)		// initialize spaces
		for (int col = 0; col < 3; col++)
			board[row][col] = ' ';
}


/*
 * Displays game board - first version.
 * This version does not use the fence post problem solution.
 */

void display(char board[][3])
{
	system("cls");		// Windows
	//system("clear");	// Linux / MacOS

	cout << "  ";					// offset for col numbers
	for (int i = 0; i < 3; i++)			// print col numbers
		cout << i << " ";
	cout << endl;

	for (int row = 0; row < 3; row++)		// prints the rows
	{
		cout << row << " " ;			// row number
		for (int col = 0; col < 3; col++)	// prints the columns
		{
			cout << board[row][col];
			if (col < 2)
				cout << VERT;
		}
		cout << endl;

		if (row < 2)
			cout << HLINE << endl;
	}

	cout << endl;
}


/* Displays game board - second version.
 * This version does use the fence post problem solution.
 */

/*void display(char board[][3])
{
	system("cls");		// Windows
	//system("clear");	// Linux / MacOS

	cout << "  ";					// offset for col numbers
	for (int i = 0; i < 3; i++)			// print col numbers
		cout << i << " ";
	cout << endl;

	for (int row = 0; row < 2; row++)
	{
		cout << row << " " ;			// row number
		for (int col = 0; col < 2; col++)	// prints first 2 columns
			cout << board[row][col] << VERT;
		cout << board[row][2] << endl;		// prints the last column

		cout << HLINE << endl;
	}

	cout << "2 " << board[0][2] << VERT << board[1][2] << VERT << board[2][2] << endl << endl;
}*/


/*
 * Displays game board - third version.
 * This version uses the fact that there are exactly three rows and three
 * columns to eliminate both loops altogether.
 */

/*void display(char board[][3])
{
	system("cls");		// Windows
	//system("clear");	// Linux / MacOS

	cout << "  0 1 2\n";				// column index labels

	cout << "0 " <<					// top row
		board[0][0] << VERT <<
		board[0][1] << VERT <<
		board[0][2] << endl;

	cout << HLINE << endl;				// horizontal board line

	cout << "1 " <<					// middle row
		board[1][0] << VERT <<
		board[1][1] << VERT <<
		board[1][2] << endl;

	cout << HLINE << endl;				// horizontal board line

	cout << "2 " <<					// bottom row
		board[2][0] << VERT <<
		board[2][1] << VERT <<
		board[2][2] << endl;

	cout << endl;
}*/


/* Get the next player's move. */

void get_move(char player, char board[][3])
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
		row < 0 || row > 3 || col < 0 || col > 3);	// row or col out of bounds

	board[row][col] = player;
}


/* Checks to see if either player has won yet. */

void test_win(char board[][3])
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

char test_board(char board[][3])
{
	for (int row = 0; row < 3; row++)		// checks rows
	{
		if (board[row][0] == ' ')
			continue;
		if (board[row][0] == board[row][1] && board[row][1] == board[row][2])
			return board[row][0];		// winner found
	}

	for (int col = 0; col < 3; col++)		// checks columns
	{
		if (board[0][col] == ' ')
			continue;
		if (board[0][col] == board[1][col] && board[1][col] == board[2][col])
			return board[0][col];		// winner found
	}


	// check the prime diagonal
	if (board[0][0] == board[1][1] && board[1][1] == board[2][2])
		return board[0][0];			// winner found

	// check the non-prime diagonal
	if (board[0][2] == board[1][1] && board[1][1] == board[2][0])
		return board[0][2];			// winner found


	return ' ';					// no winner yet
}

