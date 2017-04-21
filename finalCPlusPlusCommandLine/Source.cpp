//includes modules/custom classes
#include<iostream>
#include<sstream>
#include"Entry.h"

//specifies that the following functions/objects are to used in the program from the c++ standard library
using std::cout;
using std::endl;
using std::cin;
using std::getline;
using std::stringstream;

//declaration of constant variables on the stack

const int noCommand = 0;
const int noArg = 1;
const int oneArg = 2;
const int twoArg = 3;

const string endProgram = "exit";
const string help = "help";
const string list = "ls";
const string createDir = "mkdir";
const string createFile = "touch";
const string deleteEntry = "rm";
const string copyEntry = "cp";
const string renameEntry = "mv";

const string firstArg = " First Arguement.";
const string secondArg = " Second Arguement.";

const string duplicateError = ":There is already a file or directory with that name.";
const string notFound = ":The specified file or directory doesn't exist.";

const char directory = 'd';
const char file = 'f';

//function prototypes
bool exists(const string& entryName, vector<Entry*>& Entries);
void ls(vector<Entry*>& Entries);
void mkdir(const string& directoryName, vector<Entry*>& Entries);
void touch(const string& fileName, vector<Entry*>& Entries);
void rm(const string& entryName, vector<Entry*>& Entries);
void cp(const string& origEntry, const string& copyEntry, vector<Entry*>& Entries);
void mv(const string& oldName, const string& newName, vector<Entry*>& Entries);

//checks if a specific entry name is within the current Entries vector
bool exists(const string& entryName, vector<Entry*>& Entries) {
	for (int i = 0; i < Entries.size(); ++i) {
		if (entryName == Entries[i]->getEntryName()) {
			return true;
		}
	}
	return false;
}
//lists all the current entries on screen
void ls(vector<Entry*>& Entries) {
	for (int i = 0; i < Entries.size(); ++i) {
		cout << Entries[i]->toString();
	}
}
//creates a new directory
void mkdir(const string& directoryName,vector<Entry*>& Entries) {

	if (!exists(directoryName,Entries)) {
		Entries.emplace_back(new Entry(directoryName, directory));
		cout << ":The directory " << directoryName << " was successfully created." << endl;
	}
	else {
		cout << duplicateError << endl;
	}
	
}
//makes a new file
void touch(const string& fileName, vector<Entry*>& Entries) {
	if (!exists(fileName, Entries)) {
		Entries.emplace_back(new Entry(fileName, file));
		cout << ":The file " << fileName << " was successfully created." << endl;
	}
	else {
		cout << duplicateError << endl;
	}
}
//deletes the specified entry
void rm(const string& entryName, vector<Entry*>& Entries) {

	bool found = false;
	
	for (int i = 0; i < Entries.size(); ++i) {
		if (entryName == Entries[i]->getEntryName()) {
			Entry* temp = Entries[i];
			Entries[i] = Entries[Entries.size() - 1];
			Entries[Entries.size() - 1] = temp;
			delete Entries[Entries.size() - 1];
			Entries.pop_back();
			found = true;
			cout << ":The entry " << entryName << " was successfully deleted" << endl;
			break;
		}
	}
	if (!found) {
		cout << notFound << endl;
	}
}
//copies the specified entry's attributes and creates a new entry with the specified name
void cp(const string& origEntry, const string& copyEntry, vector<Entry*>& Entries) {
	if (origEntry != copyEntry) {

		if (!exists(copyEntry, Entries)) {
			bool found = false;

			for (int i = 0; i < Entries.size(); ++i) {
				if (origEntry == Entries[i]->getEntryName()) {
					found = true;
					Entries.emplace_back(new Entry(copyEntry, Entries[i]->getEntryType(), Entries[i]->getEntrySize()));
					cout << ":The entry " << origEntry << " was successfully copied as " << copyEntry << endl;
					break;
				}
			}

			if (!found) {
				cout << notFound << firstArg << endl;
			}
		}
		else {
			cout << duplicateError << secondArg << endl;
		}

	}
	else {
		cout << "You cannot create a copy of an entry with the same name as the original." << endl;
	}

	
	
}
//used to rename entries
void mv(const string& oldName, const string& newName, vector<Entry*>& Entries) {
	
	if (oldName != newName) {

		if (!exists(newName, Entries)) {
			bool found = false;

			for (int i = 0; i < Entries.size(); ++i) {
				if (oldName == Entries[i]->getEntryName()) {
					found = true;
					Entries[i]->setEntryName(newName);
					cout << ":The entry " << oldName << " was successfully renamed " << newName << endl;
					break;
				}
			}
			if (!found) {
				cout << notFound << firstArg << endl;
			}
		}
		else {
			cout << duplicateError << secondArg << endl;
		}

		
	}
	else {
		cout << "The new entry name is identical to the old entry name." << endl;
	}
	
}

int main() {
	//vector of entries to 
	vector<Entry*> Entries;
	

	string input;

	//used to display the commands the program can perform
	stringstream commandList;
	commandList << endProgram << ": end the program" << endl
		<< help << ": display a list of available commands" << endl
		<< list << ": list all files and directories" << endl
		<< createDir << " name: create a new empty directory" << endl
		<< createFile << " name: create a new empty text file" << endl
		<< deleteEntry << " name: delete a file or directory" << endl
		<< copyEntry << " name nameOfCopy: copy a file or directory" << endl
		<< renameEntry << " oldName newName: rename a file or directory" << endl;
	

	//creates initial entries that are placed in the Entries vector
	Entries.emplace_back(new Entry("public_html", directory, 555554));
	Entries.emplace_back(new Entry("Stellaris.txt", file, 2333));
	Entries.emplace_back(new Entry("MicrosoftsBlunder.txt", file, 3353234));
	Entries.emplace_back(new Entry("Essay.txt", file, 324322));
	Entries.emplace_back(new Entry("downloads", directory, 325342));

	cout << commandList.str();

	cout << endl << ":";

	//retrieves initial user input
	getline(cin,input);

	//while the user doesn't enter the end program command, the program will continue to run and process user input
	while (input != endProgram) {

		vector<string> Arguements;
		stringstream ss;
		int size;

		ss.str(input);
		//separates the inidividual arguements of the inputed command and places them in the arguements vector
		while (ss >> input) {
			Arguements.push_back(input);
		}
		//retireves the number of arguements ni the recieved command
		size = Arguements.size();
		//checks if the user input an empty command
		if (size != noCommand) {
			//determines which command the user entered and calls the appropriate method to carry out the user wishes
			if (Arguements[0] == help && size == noArg) {
				cout << commandList.str();
			}
			else if (Arguements[0] == list && size == noArg) {
				ls(Entries);
			}
			else if (Arguements[0] == createDir && size == oneArg) {
				mkdir(Arguements[1], Entries);
			}
			else if (Arguements[0] == createFile && size == oneArg) {
				touch(Arguements[1], Entries);
			}
			else if (Arguements[0] == deleteEntry && size == oneArg) {
				rm(Arguements[1], Entries);
			}
			else if (Arguements[0] == copyEntry && size == twoArg) {
				cp(Arguements[1], Arguements[2], Entries);
			}
			else if (Arguements[0] == renameEntry&& size == twoArg) {
				mv(Arguements[1], Arguements[2], Entries);
			}
			else {
				cout << "Invalid command. Type 'help' to print out a list of valid commands and their syntax." << endl;
			}
		}
		else {
			cout << "No command entered." << endl;
		}
		

		cout << endl << ":";
		getline(cin, input);

	}
	//deletes the elements in Entries to prevent memory leaks
	for (int i = 0; i < Entries.size(); ++i) {
		delete Entries[i];
	}

	return 0;
}