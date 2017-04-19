#include <iostream>

# include <math.h>

using namespace std;
int N = 10;
class Point
{
int j = 1;

public:

Point() {cout << "j=" << j << " constructor is called" << endl;j++;}

Point (double x1,double y1){x=x1,y=y1; cout << "j=" << j << " constructor called" << endl;j++;}

~Point (){cout << "j=" << j-1 << " destructor is called" << endl;j--;}

double x,y;

};

void Set(Point *p)

{

    for (int i=0;i<N;i++)

    {

        cout << "\n请设置第" << i+1 << "个类对象的属性" << endl;

        cout << "请输入x的值\n" << "x=";

        cin >> p[i].x;

        cout << "请输入y的值\n" << "y=";

        cin >> p[i].y;

    }// end for (i=0;i<10;i++)

}

int Length(Point *p)

{

    double s=0,n,m;

    for (int i=0;i<N-1;i++)

    { n=p[i].x-p[i+1].x;

        m=p[i+1].y-p[i].y;

        s+=sqrt(m*m+n*n);

    }

    cout << " 这" << N << "个点所连接而成的折线的总长度s为:\n" << "s=" << s << endl; return s;
}

void Display(Point *p)

{

    for ( int i=0;i<N;i++)

        cout << "\n p[" << i << "]=" << "(" << p[i].x << "," <<  p[i].y << ")" << endl; }

int main()

{

    Point *p;

    p=new Point[N]; Set(p); Display(p);

    Length(p);

    delete []p;
    return 0;
}