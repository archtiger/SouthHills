#include<string>
#include<vector>

using std::string;
using std::vector;

#ifndef Entry_H
#define Entry_H 

class Entry {
public:

	Entry(string entryName, char entryType, int entrySize = 0);
	~Entry();
	string getEntryName();
	string getEntryTime();
	int getEntrySize();
	char getEntryType();

	string toString();

	void setEntryName(string entryName);

private:

	string entryName;
	string entryTimeCreated;
	int entrySize;
	char entryType;
	static const vector<char> validEntryTypes;

};


#endif