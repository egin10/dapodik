#include <iostream>
#include <stdio.h>
#include <string>

using namespace std;

int main(){
	string cmd;
	
	system("clear");
	start :

	cout << "*========================================================*" << endl;
	cout << "||\tAplikasi Download Data Refrensi Sekolah\t\t||" << endl;
	cout << "||\t\tDari Website Dapodik\t\t\t||" << endl;
	cout << "||\thttp://referensi.data.kemdikbud.go.id\t\t||" << endl;
	cout << "*========================================================*" << endl;
	
	int a;
	cout << "1. Download Data Sekolah Se-Provinsi. " << endl;
	cout << "2. Check NPSN Beberapa Sekolah (excel). " << endl;
	cout << "3. Exit. " << endl;
	cout << "Pilih Menu : ";
	cin >> a;

	switch(a){
		case 1: //Download Data Sekolah
			system("clear");
			
			menu1:
			cout << "*========================================================*" << endl;
			cout << "||\tAplikasi Download Data Refrensi Sekolah\t\t||" << endl;
			cout << "||\t\tDari Website Dapodik\t\t\t||" << endl;
			cout << "||\thttp://referensi.data.kemdikbud.go.id\t\t||" << endl;
			cout << "*========================================================*" << endl;
			
			int b;
			cout << "1. Lihat list Provinsi Se-Indonesia. " << endl;
			cout << "2. Download Data Sekolah. " << endl;
			cout << "3. Kembali. " << endl;
			cout << "4. Exit. " << endl;
			cout << "Pilih Menu : ";
			cin >> b;

			switch(b){
				case 1:
					system("clear");
					system("php ../listProvinsi.php");
					goto menu1;
					break;
				case 2:
					system("clear");
					int noProv;
					cout << "Silahkan masukan No Provinsi anda : ";
					cin >> noProv;
					// cout << noProv << endl;
					
					cmd = "php ../npsn-per-provinsi.php " + to_string(noProv);
					cout << "Start...\n";
					// this line call php download
					system(cmd.c_str());
					cout << "Selesai...\n";
					cout << "Silahkan check file di folder FILES.\n";
					goto menu1;
					break;
				case 3:
					system("clear");
					goto start;
					break;
				case 4:
					system("clear");
					cout << "Terimakasih. Exit...\n";
					exit(1);
					break;
				default:
					system("clear");
					cout << "Inputan salah...\n";
					goto menu1;
					break;		
			}
			break;

		case 2:
			system("clear");
			
			menu2:
			cout << "*========================================================*" << endl;
			cout << "||\tAplikasi Download Data Refrensi Sekolah\t\t||" << endl;
			cout << "||\t\tDari Website Dapodik\t\t\t||" << endl;
			cout << "||\thttp://referensi.data.kemdikbud.go.id\t\t||" << endl;
			cout << "*========================================================*" << endl;
			
			int c;
			cout << "Pastikan anda telah memasukan list NPSN di file npsn.xlsx. " << endl;
			cout << "Setelah memasukan list NPSN jangan lupa di save. " << endl;
			cout << "1. Jalankan. " << endl;
			cout << "2. Kembali. " << endl;
			cout << "3. Exit. " << endl;
			cout << "Pilih Menu : ";
			cin >> c;

			switch(c){
				case 1:
					system("clear");
					cout << "Check NPSN...\n";
					// call php for checking list NPSN
					cout << "Selesai...\n";
					goto menu2;
					break;
				case 2:
					system("clear");
					goto start;
					break;
				case 3:
					system("clear");
					cout << "Terimakasih. Exit...\n";
					exit(1);
					break;
				default:
					system("clear");
					cout << "Inputan salah...\n";
					goto menu2;
					break;
			}
			break;

		case 3:
			system("clear");
			cout << "Terimakasih. Exit...\n";
			exit(1);
			break;

		default:
			system("clear");
			cout << "Inputan salah...\n";
			goto start;
			break;
	}

    return 0;
}