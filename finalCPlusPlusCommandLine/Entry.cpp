#include<iostream>
#include<sstream>
#include<ctime>
#include"Entry.h"

using std::time_t;
using std::cout;
using std::endl;
using std::cin;
using std::stringstream;

const vector<char> Entry::validEntryTypes = { 'f','d' };

Entry::Entry(string entryName, char entryType, int entrySize) {

	this->entryName = entryName;
	this->entrySize = entrySize;

	if (tolower(entryType) != validEntryTypes[0] && tolower(entryType) != validEntryTypes[1]) {
		this->entryType = validEntryTypes[0];
	}
	else {
		this->entryType = entryType;
	}

	time_t now = time(0);

	this->entryTimeCreated = ctime(&now);

}

string Entry::getEntryName() {
	return entryName;
}

char Entry::getEntryType() {
	return entryType;
}

string Entry::getEntryTime() {
	return entryTimeCreated;
}

int Entry::getEntrySize() {
	return entrySize;
}

void Entry::setEntryName(string entryName) {
	this->entryName = entryName;
}

string Entry::toString() {
	stringstream ss;

	ss << "Entry Name: " << entryName << " | Entry Type: ";
	if (entryType == validEntryTypes[0]) {
		ss << "File";
	}
	else {
		ss << "Directory";
	}

	ss << " | Entry Size: " << entrySize << " bytes | Created on: " << entryTimeCreated << endl;

	return ss.str();
}


Entry::~Entry() {
	cout << "Entry destroyed" << endl;
}


